<?php

namespace App\Http\Controllers\Api\Kecamatan;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\Barang\Barang;
use App\Models\Barang\JenisBarang;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('role:kecamatan', ['except' => ['index']]);
        $this->middleware('role:kecamatan|posko-utama|posko', ['except' => ['createOrEdit', 'store', 'update', 'destroy']]);
    }

    public function index(Request $request)
    {
        try {

            // Mengambil data barang beserta relasi 'jenisBarang' menggunakan eager loading
            $barang = Barang::whereNull('deleted_by')->whereNull('deleted_at')->with([
                'jenisBarang' // Memuat relasi 'jenisBarang' untuk setiap barang
            ]); // Membatasi hasil menjadi 10 data per halaman

            if (isset($request->all) && $request->all) {
                return ApiResponse::success($barang->get());
            }

            // Mengembalikan respons sukses dengan data barang yang dipaginasi
            return ApiResponse::success($barang->paginate(10));
        } catch (\Throwable $th) {
            // Menangkap exception dan mengembalikan pesan error dengan status 500 (internal server error)
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function createOrEdit()
    {
        try {

            $jenis_barang = JenisBarang::whereNull('deleted_by')->whereNull('deleted_at')->get();

            return ApiResponse::success([
                'jenis_barang' => $jenis_barang
            ]);
        } catch (\Throwable $th) {

            return ApiResponse::badRequest($th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            // Memulai transaksi database
            DB::beginTransaction();

            // Validasi input dari request
            $validator = Validator::make($request->all(), [
                'nama_barang' => 'required|string|max:255', // nama_barang wajib, maksimal 255 karakter
                'jenis_barang' => 'required|integer|max:15', // jenis_barang wajib, harus integer dengan maksimal 15 karakter
                'harga_satuan' => 'required|integer', // harga_satuan wajib, harus integer
            ]);

            // Jika validasi gagal, kembalikan respons error validasi dengan kode 422
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // Membuat data barang baru
            $barang = Barang::lockForUpdate()->create([
                'NamaBarang' => $request->nama_barang,
                'IDJenisBarang' => $request->jenis_barang,
                'HargaSatuan' => $request->harga_satuan,
                'LastUpdateDate' => now(),
            ]);

            // Jika berhasil, komit transaksi dan kembalikan respons sukses
            if ($barang) {
                DB::commit();
                return ApiResponse::created($barang);
            } else {
                // Jika gagal, rollback transaksi
                DB::rollback();
                return ApiResponse::notFound('Data barang tidak ditemukan.');
            }
        } catch (\Throwable $th) {
            // Rollback transaksi jika terjadi exception
            DB::rollback();
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {

            $barang = Barang::with([
                'jenisBarang'
            ])->where('IDBarang', $id)->first();

            // Jika data barang ditemukan
            if (!is_null($barang)) {
                return ApiResponse::success($barang); // Mengembalikan respons sukses dengan data barang
            }

            // Jika tidak ditemukan, kembalikan respons not found
            return ApiResponse::notFound('Data barang tidak ditemukan.');
        } catch (\Throwable $th) {
            // Menangkap exception dan mengembalikan pesan error dengan status 500
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Memulai transaksi database
            DB::beginTransaction();

            // Validasi input dari request
            $validator = Validator::make($request->all(), [
                'nama_barang' => 'required|string|max:255', // nama_barang wajib, maksimal 255 karakter
                'jenis_barang' => 'required|integer|max:15', // jenis_barang wajib, harus integer dengan maksimal 15 karakter
                'harga_satuan' => 'required|integer', // harga_satuan wajib, harus integer
            ]);

            // Jika validasi gagal, kembalikan respons error validasi dengan kode 422
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // Mengupdate data barang berdasarkan IDBarang
            Barang::where('IDBarang', $id)->update([
                'NamaBarang' => $request->nama_barang,
                'IDJenisBarang' => $request->jenis_barang,
                'HargaSatuan' => $request->harga_satuan,
                'LastUpdateDate' => now(),
            ]);

            DB::commit();
            return ApiResponse::success(Barang::with([
                'jenisBarang'
            ])->where('IDBarang', $id)->first());
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();

            Barang::where('IDBarang', $id)->update([
                'deleted_at' => Carbon::now(),
                'deleted_by' => Auth::user()->id,
            ]);

            DB::commit();
            return ApiResponse::success('Barang berhasil dihapus');
        } catch (Exception $e) {
            DB::rollBack();
            return ApiResponse::badRequest($e->getMessage());
        }
    }
}
