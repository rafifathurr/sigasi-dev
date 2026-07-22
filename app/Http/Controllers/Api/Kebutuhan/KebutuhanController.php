<?php

namespace App\Http\Controllers\Api\Kebutuhan;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\Barang\Barang;
use App\Models\Kebutuhan\Kebutuhan;
use App\Models\Posko\Posko;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KebutuhanController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('role:posko-utama|posko');
    }

    public function index(Request $request)
    {
        // menampilkan data kebutuhan dengan dibatasi 10 record
        $data_kebutuhan = Kebutuhan::with(['posko.user', 'barang.jenisBarang', 'user'])->whereNull('deleted_by')->whereNull('deleted_at');

        // pencarian berdasarkan id posko
        if (isset($request->posko)) {
            $data_kebutuhan = $data_kebutuhan->where('IDPosko', $request->posko);
        }

        if (isset($request->all) && $request->all) {
            return ApiResponse::success($data_kebutuhan->get());
        }

        return ApiResponse::success($data_kebutuhan->paginate(10));
    }

    public function createOrEdit(Request $request)
    {
        try {

            $barang = Barang::whereNull('deleted_by')->whereNull('deleted_at')->get();
            $posko = Posko::with(['user'])->whereNull('deleted_by')->whereNull('deleted_at');

            $data['barang'] = $barang;
            $data['poskos'] = $posko->get();

            if (auth()->user()->hasRole('posko')) {
                $data['posko'] = $posko->where('Ketua', auth()->user()->id)->first();
            }

            if (isset($request->id)) {

                /**
                 * Get Record from id
                 */
                $kebutuhan = Kebutuhan::with(['posko.user', 'barang.jenisBarang'])->where('IDKebutuhan', $request->id)->first();

                /**
                 * Validation kebutuhan id
                 */
                if (!is_null($kebutuhan)) {
                    $data['kebutuhan'] = $kebutuhan;
                } else {
                    return ApiResponse::notFound('Data kebutuhan tidak ditemukan.');
                }
            }

            return ApiResponse::success($data);
        } catch (\Throwable $th) {

            return ApiResponse::badRequest($th->getMessage());
        }
    }

    public function show($id)  // id yang digunakan idposko
    {
        // tampilan data kebutuhan
        $kebutuhan = Kebutuhan::with(['posko.user', 'barang.jenisBarang', 'user'])->where('IDKebutuhan', $id)->first();

        if (is_null($kebutuhan)) {
            return ApiResponse::notFound('Data kebutuhan tidak ditemukan.');
        }

        return ApiResponse::success($kebutuhan);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [ // cek validasi sesuai parameter
                'idPosko' => 'numeric',
            ]);

            if ($validator->fails()) { // jika parameter ada yang tidak sesuai maka return error
                return ApiResponse::badRequest($validator->errors());
            }

            DB::beginTransaction();
            $arr_kebutuhan = []; // menampung data

            foreach ($request->product as $product) {

                $kebutuhan = Kebutuhan::lockForUpdate()->create([
                    'IDBarang' => $product['idProduct'],
                    'IDPosko' => $request->idPosko,
                    'JumlahKebutuhan' => $product['qty'],
                    'LastUpdateDate' => Carbon::now(),
                    'LastUpdateBy' => Auth::user()->id,
                ]);

                if (!$kebutuhan) { // jika kebutuhan ada error, maka batalkan update dan return error
                    DB::rollBack();
                    return ApiResponse::notFound('Data kebutuhan tidak dapat disimpan.');
                }

                array_push($arr_kebutuhan, $kebutuhan); // jika tidak error maka mengirimkan array
            }

            DB::commit();
            return ApiResponse::created($arr_kebutuhan); // memnuat record baru
        } catch (Exception $e) {
            return ApiResponse::badRequest($e);
        }
    }

    public function qtyReceived(Request $request, $id) // untuk mengisi jumlah yang diterima
    {
        try {
            $validator = Validator::make($request->all(), [
                'qty' => 'numeric',
            ]);

            if ($validator->fails()) {
                return ApiResponse::badRequest($validator->errors());
            }

            DB::beginTransaction();
            Kebutuhan::where('IDKebutuhan', $id)->update([
                'JumlahDiterima' => $request->qty,
                'LastUpdateDate' => Carbon::now(),
                'LastUpdateBy' => Auth::user()->id,
            ]);

            DB::commit();
            $data_kebutuhan = Kebutuhan::with(['posko.user', 'barang.jenisBarang'])->where('IDKebutuhan', $id)->first();
            return ApiResponse::success($data_kebutuhan);
        } catch (Exception $e) {
            DB::rollBack();
            return ApiResponse::badRequest($e);
        }
    }

    public function update(Request $request, $id) // untuk mengisi jumlah yang diterima
    {
        try {
            $validator = Validator::make($request->all(), [
                'idPosko' => 'numeric',
            ]);

            if ($validator->fails()) {
                return ApiResponse::badRequest($validator->errors());
            }

            DB::beginTransaction(); // memulai transaksi

            // update data kebutuhan
            Kebutuhan::where('IDKebutuhan', $id)->update([
                'IDBarang' => $request->idProduct,
                'IDPosko' => $request->idPosko,
                'JumlahKebutuhan' => $request->qtyRequest,
                'JumlahDiterima' => $request->qtyReceived,
                'LastUpdateDate' => Carbon::now(),
                'LastUpdateBy' => Auth::user()->id,
            ]);

            DB::commit();
            $data_kebutuhan = Kebutuhan::with(['posko.user', 'barang.jenisBarang'])->where('IDKebutuhan', $id)->first();
            return ApiResponse::success($data_kebutuhan);
        } catch (Exception $e) {
            DB::rollBack();
            return ApiResponse::badRequest($e);
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();

            Kebutuhan::where('IDKebutuhan', $id)->update([
                'deleted_at' => Carbon::now(),
                'deleted_by' => Auth::user()->id,
            ]);

            DB::commit();
            return ApiResponse::success('Kebutuhan berhasil dihapus');
        } catch (Exception $e) {
            DB::rollBack();
            return ApiResponse::badRequest($e->getMessage());
        }
    }
}
