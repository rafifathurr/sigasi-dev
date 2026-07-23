<?php

namespace App\Http\Controllers\Api\RencanaAnggaran;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\Bantuan\Bantuan;
use App\Models\Barang\Barang;
use App\Models\RencanaAnggaran\RencanaAnggaran;
use App\Models\RencanaAnggaran\RencanaAnggaranItems;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RencanaAnggaranController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('role:kecamatan');
    }

    public function index(Request $request)
    {
        $rencana_anggaran = RencanaAnggaran::with(['rencanaAnggaranItems.barang.jenisBarang', 'rencanaAnggaranItems.bantuan.donatur', 'createdBy', 'updatedBy'])->whereNull('deleted_by')->whereNull('deleted_at');

        if (isset($request->all) && $request->all) {
            return ApiResponse::success($rencana_anggaran->get());
        }

        return ApiResponse::success($rencana_anggaran->paginate(10));
    }

    public function createOrEdit(Request $request)
    {
        try {

            $bantuan_id = array_unique(RencanaAnggaranItems::whereNull('deleted_by')->whereNull('deleted_at')->pluck('IDBantuan')->toArray());
            $bantuan = Bantuan::with(['donatur'])->whereNull('deleted_by')->whereNull('deleted_at');

            if (isset($request->id)) {

                /**
                 * Get Record from id
                 */
                $rencana_anggaran = RencanaAnggaran::with(['rencanaAnggaranItems.barang.jenisBarang', 'rencanaAnggaranItems.bantuan.donatur'])->where('IDRencanaAnggaran', $request->id)->first();

                /**
                 * Validation rencana anggaran id
                 */
                if (!is_null($rencana_anggaran)) {

                    foreach ($rencana_anggaran->rencanaAnggaranItems as $item) {
                        if (($key = array_search($item->IDBantuan, $bantuan_id)) !== false) {
                            unset($bantuan_id[$key]);
                        }
                    }

                    $data['rencana_anggaran'] = $rencana_anggaran;
                } else {
                    return ApiResponse::notFound('Data rencana anggaran tidak ditemukan.');
                }
            }

            $data['bantuans'] = !empty($bantuan_id) ? $bantuan->whereNotIn('IDBantuan', $bantuan_id)->get() : $bantuan->get();

            return ApiResponse::success($data);
        } catch (\Throwable $th) {

            return ApiResponse::badRequest($th->getMessage());
        }
    }

    public function show($id)  // id yang digunakan idposko
    {
        // tampilan data berdasarkan id posko
        $rencana_anggaran = RencanaAnggaran::with(['rencanaAnggaranItems.barang.jenisBarang', 'rencanaAnggaranItems.bantuan.donatur', 'createdBy', 'updatedBy'])->where('IDRencanaAnggaran', $id)->first();

        if (is_null($rencana_anggaran)) {
            return ApiResponse::notFound('Data rencana anggaran tidak ditemukan.');
        }

        return ApiResponse::success($rencana_anggaran);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [ // cek validasi sesuai parameter
                'TanggalRencana' => 'required',
                'NilaiAnggaran' => 'numeric',
                'barang' => 'required|array',
            ]);

            if ($validator->fails()) { // jika parameter ada yang tidak sesuai maka return error
                return ApiResponse::badRequest($validator->errors());
            }

            $total_nilai_anggaran = 0;
            foreach ($request->barang as $barang) {

                if (!isset($barang['IDBarang'])) {
                    return ApiResponse::badRequest('IDBarang harus diisi untuk setiap item barang.');
                }

                $check_barang = Barang::where('IDBarang', $barang['IDBarang'])->first();

                if (is_null($check_barang)) {
                    return ApiResponse::notFound('Barang dengan ID ' . $barang['IDBarang'] . ' tidak ditemukan.');
                }

                $barang['HargaSatuan'] = $check_barang->HargaSatuan;
                $total_nilai_anggaran += (intval($check_barang->HargaSatuan) * intval($barang['Jumlah']));
            }

            if ($request->NilaiAnggaran > $total_nilai_anggaran) {
                return ApiResponse::badRequest('Nilai anggaran tidak boleh lebih besar dari total harga barang.');
            }

            DB::beginTransaction();

            // Membuat data rencana anggaran baru
            $rencana_anggaran = RencanaAnggaran::lockForUpdate()->create([
                'TanggalRencana' => $request->TanggalRencana,
                'NilaiAnggaran' => $request->NilaiAnggaran,
                'Keterangan' => $request->Keterangan,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            // Jika berhasil, komit transaksi dan kembalikan respons sukses
            if ($rencana_anggaran) {

                foreach ($request->barang as $barang) {
                    $rencana_anggaran_items = RencanaAnggaranItems::lockForUpdate()->create([
                        'IDRencanaAnggaran' => $rencana_anggaran->IDRencanaAnggaran,
                        'IDBantuan' => $barang['IDBantuan'],
                        'IDBarang' => $barang['IDBarang'],
                        'Jumlah' => $barang['Jumlah'],
                        'HargaSatuan' => $barang['HargaSatuan'],
                        'created_by' => auth()->user()->id,
                        'updated_by' => auth()->user()->id,
                    ]);

                    if (!$rencana_anggaran_items) {
                        DB::rollback();
                        return ApiResponse::badRequest();
                    }
                }

                DB::commit();
                return ApiResponse::created($rencana_anggaran);
            } else {
                // Jika gagal, rollback transaksi
                DB::rollback();
                return ApiResponse::badRequest();
            }
        } catch (Exception $e) {
            return ApiResponse::badRequest($e);
        }
    }

    public function update(Request $request, $id) // untuk mengisi jumlah yang diterima
    {
        try {
            $validator = Validator::make($request->all(), [ // cek validasi sesuai parameter
                'TanggalRencana' => 'required',
                'NilaiAnggaran' => 'numeric',
                'barang' => 'required|array',
            ]);

            if ($validator->fails()) { // jika parameter ada yang tidak sesuai maka return error
                return ApiResponse::badRequest($validator->errors());
            }

            $total_nilai_anggaran = 0;
            foreach ($request->barang as $barang) {

                if (!isset($barang['IDBarang'])) {
                    return ApiResponse::badRequest('IDBarang harus diisi untuk setiap item barang.');
                }

                $check_barang = Barang::where('IDBarang', $barang['IDBarang'])->first();

                if (is_null($check_barang)) {
                    return ApiResponse::notFound('Barang dengan ID ' . $barang['IDBarang'] . ' tidak ditemukan.');
                }

                $barang['HargaSatuan'] = $check_barang->HargaSatuan;
                $total_nilai_anggaran += (intval($check_barang->HargaSatuan) * intval($barang['Jumlah']));
            }

            if ($request->NilaiAnggaran > $total_nilai_anggaran) {
                return ApiResponse::badRequest('Nilai anggaran tidak boleh lebih besar dari total harga barang.');
            }

            DB::beginTransaction(); // memulai transaksi

            // update data distribusi bantuan
            RencanaAnggaran::where('IDRencanaAnggaran', $id)->update([
                'TanggalRencana' => $request->TanggalRencana,
                'NilaiAnggaran' => $request->NilaiAnggaran,
                'Keterangan' => $request->Keterangan,
                'updated_by' => auth()->user()->id,
            ]);

            RencanaAnggaranItems::where('IDRencanaAnggaran', $id)->delete();

            foreach ($request->barang as $barang) {
                $rencana_anggaran_items = RencanaAnggaranItems::lockForUpdate()->create([
                    'IDRencanaAnggaran' => $id,
                    'IDBantuan' => $barang['IDBantuan'],
                    'IDBarang' => $barang['IDBarang'],
                    'Jumlah' => $barang['Jumlah'],
                    'HargaSatuan' => $barang['HargaSatuan'],
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                ]);

                if (!$rencana_anggaran_items) {
                    DB::rollback();
                    return ApiResponse::badRequest();
                }
            }

            DB::commit();
            $data_rencana_anggaran = RencanaAnggaran::with(['rencanaAnggaranItems.barang.jenisBarang', 'rencanaAnggaranItems.bantuan.donatur', 'createdBy', 'updatedBy'])->where('IDRencanaAnggaran', $id)->first();
            return ApiResponse::success($data_rencana_anggaran);
        } catch (Exception $e) {
            DB::rollback();
            return ApiResponse::badRequest($e);
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();

            RencanaAnggaran::where('IDRencanaAnggaran', $id)->update([
                'deleted_at' => Carbon::now(),
                'deleted_by' => Auth::user()->id,
            ]);

            RencanaAnggaranItems::where('IDRencanaAnggaran', $id)->update([
                'deleted_at' => Carbon::now(),
                'deleted_by' => Auth::user()->id,
            ]);

            DB::commit();
            return ApiResponse::success('Rencana anggaran berhasil dihapus');
        } catch (Exception $e) {
            DB::rollback();
            return ApiResponse::badRequest($e->getMessage());
        }
    }
}
