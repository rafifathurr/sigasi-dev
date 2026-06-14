<?php

namespace App\Http\Controllers\Api\Kecamatan;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\Barang\JenisBarang;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class JenisBarangController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('role:kecamatan');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

            $jenis_barang = JenisBarang::whereNull('deleted_by')->whereNull('deleted_at');

            if (isset($request->all) && $request->all) {
                return ApiResponse::success($jenis_barang->get());
            }

            // Mengembalikan response sukses dengan data jenis barang
            return ApiResponse::success($jenis_barang->paginate(10));
        } catch (\Throwable $th) {
            // Menangkap exception dan mengembalikan pesan error dengan status 500 (internal server error)
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Memulai transaksi database
            DB::beginTransaction();

            // Validasi input dari request
            $validator = Validator::make($request->all(), [
                'jenis_barang' => 'required|string|max:15', // jenis_barang wajib, maksimal 15 karakter
            ]);

            // Jika validasi gagal, kembalikan error validasi dengan status 422
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // Membuat data jenis barang baru dengan kunci untuk mencegah konflik
            $store_jenis_barang = JenisBarang::lockForUpdate()->create([
                'JenisBarang' => $request->jenis_barang,
                'LastUpdateDate' => now(),
            ]);

            // Jika berhasil, commit transaksi dan kembalikan response sukses
            if ($store_jenis_barang) {
                DB::commit();
                return ApiResponse::created($store_jenis_barang);
            }

            // Rollback jika gagal
            DB::rollback();
            return ApiResponse::badRequest();
        } catch (\Throwable $th) {
            // Rollback transaksi jika terjadi exception
            DB::rollback();
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // Mencari data jenis barang berdasarkan IDJenisBarang
            $jenis_barang = JenisBarang::where('IDJenisBarang', $id)->first();

            // Jika ditemukan, kembalikan response sukses
            if (!is_null($jenis_barang)) {
                return ApiResponse::success($jenis_barang);
            }

            // Jika tidak ditemukan, kembalikan response bad request
            return ApiResponse::badRequest();
        } catch (\Throwable $th) {
            // Menangkap exception dan mengembalikan pesan error dengan status 500
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Memulai transaksi database
            DB::beginTransaction();

            // Validasi input dari request
            $validator = Validator::make($request->all(), [
                'jenis_barang' => 'required|string|max:15', // jenis_barang wajib, maksimal 15 karakter
            ]);

            // Jika validasi gagal, kembalikan error validasi dengan status 422
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // Update data jenis barang berdasarkan IDJenisBarang
            JenisBarang::where('IDJenisBarang', $id)->update([
                'JenisBarang' => $request->jenis_barang,
                'LastUpdateDate' => now(),
            ]);

            DB::commit();
            return ApiResponse::success(JenisBarang::where('IDJenisBarang', $id)->first());
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        try {
            DB::beginTransaction();

            JenisBarang::where('IDJenisBarang', $id)->update([
                'deleted_at' => Carbon::now(),
                'deleted_by' => Auth::user()->id,
            ]);

            DB::commit();
            return ApiResponse::success('Jenis barang berhasil dihapus');
        } catch (Exception $e) {
            DB::rollBack();
            return ApiResponse::badRequest($e->getMessage());
        }
    }
}
