<?php

namespace App\Http\Controllers\Api\Posko;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\Posko\Posko;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PoskoController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        /**
         * Super Posko Utama Access
         */
        $this->middleware('role:posko-utama', ['except' => ['index', 'show']]);

        /**
         * Super Posko Utama and Posko Access
         */
        $this->middleware('role:posko-utama|posko', ['except' => ['createOrEdit', 'store', 'update', 'destroy']]);
    }

    public function index(Request $request)
    {
        $posko = Posko::with(['user'])->whereNull('deleted_by')->whereNull('deleted_at'); // untuk dapatkan semua data posko, dengan dibatasi 10 data

        // pencarian berdasarkan id posko
        if (isset($request->user)) {
            $posko = $posko->where('Ketua', $request->user);
        }

        if (isset($request->all) && $request->all) {
            return ApiResponse::success($posko->get());
        }

        return ApiResponse::success($posko->paginate(10));
    }

    public function show($id)
    {
        // menampilkan data posko berdasarkan parameter id dengan relasi user
        $posko = Posko::with(['user'])->where('IDPosko', $id)->first();

        if (is_null($posko)) { // jika posko tidak ada, maka masuk kondisi error
            return ApiResponse::notFound('Data posko tidak ditemukan.');
        }

        return ApiResponse::success($posko); // data dari posko
    }

    public function createOrEdit(Request $request)
    {
        try {

            $posko_id = Posko::whereNull('deleted_by')->whereNull('deleted_at')->pluck('Ketua')->toArray();

            $users = !empty($posko_id) ? User::with(['roles'])->whereNull('deleted_at')->whereNotIn('id', $posko_id)->whereHas('roles', function ($query) {
                $query->where('id', 2);
            })->get() : User::with(['roles'])->whereNull('deleted_at')->whereHas('roles', function ($query) {
                $query->where('id', 2);
            })->get();

            $data = [
                'users' => $users,
            ];

            if (isset($request->id)) {

                /**
                 * Get Posko Record from id
                 */
                $posko = Posko::with(['user'])->where('IDPosko', $request->id)->first();

                /**
                 * Validation posko id
                 */
                if (!is_null($posko)) {

                    $posko_id = array_filter($posko_id, function ($row) use ($posko) {
                        return $row != $posko->Ketua;
                    });

                    $users = User::with(['roles'])->whereNull('deleted_at')->whereNotIn('id', $posko_id)->whereHas('roles', function ($query) {
                        $query->where('id', 2);
                    })->get();

                    $data = [
                        'users' => $users,
                        'posko' => $posko,
                    ];
                } else {
                    return ApiResponse::notFound('Data posko tidak ditemukan.');
                }
            }

            return ApiResponse::success($data);
        } catch (\Throwable $th) {

            return ApiResponse::badRequest($th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [ // validasi data
                'idUser' => 'required|numeric',
                'location' => 'required',
                'problem' => 'required',
                'solution' => 'required',
            ]);

            if ($validator->fails()) { // jika ada parameter yang tidak sesuai maka muncul pesan error
                return ApiResponse::badRequest($validator->errors());
            }

            DB::beginTransaction(); // memulai data transaksi
            $posko = Posko::lockForUpdate()->create([ // membuat record baru
                'Ketua' => $request->idUser,
                'Lokasi' => $request->location,
                'Masalah' => $request->problem,
                'SolusiMasalah' => $request->solution,
            ]);

            if ($posko) { // jika kondisi ada maka lakukan commit
                DB::commit();
                return ApiResponse::created($posko);
            } else { // jika datanya tidak ada, maka lakukan error
                DB::rollBack();
                return ApiResponse::badRequest('Data posko tidak dapat disimpan.');
            }
        } catch (Exception $e) { // jika query ada yang salah maka tampil disini
            return ApiResponse::badRequest('Data tidak dapat disimpan.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'idUser' => 'required|numeric',
                'location' => 'required',
                'problem' => 'required',
                'solution' => 'required',
            ]);

            if ($validator->fails()) {
                return ApiResponse::badRequest($validator->errors());
            }

            DB::beginTransaction();
            Posko::where('IDPosko', $id)->update([ // update data berdasarkan id posko
                'Ketua' => $request->idUser,
                'Lokasi' => $request->location,
                'Masalah' => $request->problem,
                'SolusiMasalah' => $request->solution,
            ]);

            DB::commit();
            $data_posko =  Posko::with(['user'])->where('IDPosko', $id)->first(); // amnil data kembali yang terbaru
            return ApiResponse::success($data_posko);
        } catch (Exception $e) {
            DB::rollBack();
            return ApiResponse::badRequest($e);
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();

            Posko::where('IDPosko', $id)->update([
                'deleted_at' => Carbon::now(),
                'deleted_by' => Auth::user()->id,
            ]);

            DB::commit();
            return ApiResponse::success('Posko berhasil dihapus');
        } catch (Exception $e) {
            DB::rollBack();
            return ApiResponse::badRequest($e->getMessage());
        }
    }
}
