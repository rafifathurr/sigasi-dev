<?php

namespace App\Http\Controllers\Api\UserManagement;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\Posko\Posko;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserManagementController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('role:posko-utama|posko');
    }

    public function index(Request $request)
    {
        $user = User::with('roles')->whereNull('deleted_at');

        if (isset($request->all) && $request->all) {
            return ApiResponse::success($user->get());
        }

        return ApiResponse::success($user->paginate(10));
    }

    public function createOrEdit(Request $request)
    {
        try {

            $posko = Posko::whereNull('deleted_by')->whereNull('deleted_at')->get();
            $roles = Role::all();

            $data = [
                'posko' => $posko,
                'roles' => $roles
            ];

            if (isset($request->id)) {

                /**
                 * Get User Record from id
                 */
                $user = User::find($request->id);

                /**
                 * Validation User id
                 */
                if (!is_null($user)) {

                    $data['user'] = $user;

                    /**
                     * User Role Configuration
                     */
                    $data['user_role'] = $user->getRoleNames()[0];
                    $data['user_role_name'] = ucwords(implode(' ', explode('-', $user->getRoleNames()[0])));
                } else {
                    return ApiResponse::notFound('Data user tidak ditemukan.');
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
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email',
                'username' => 'required|string',
                'role' => 'required',
                'phone' => 'required|max:13',
                'password' => 'required|string|confirmed',
            ]);

            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'IDPosko' => $request->idPosko,
            ]);

            $roleName = Role::find($request->role)->name;

            $model_has_role = $user->assignRole($roleName);

            /**
             * Validation Submit
             */
            if ($user && $model_has_role) {
                DB::commit();
                return ApiResponse::created($user);
            } else {
                DB::rollBack();
                return ApiResponse::badRequest('user gagal disimpan');
            }
        } catch (Exception $e) {
            return ApiResponse::badRequest($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            /**
             * Get User Record from id
             */
            $user = User::find($id);

            /**
             * Validation User id
             */
            if (!is_null($user)) {

                $data['user'] = $user;

                /**
                 * User Role Configuration
                 */
                $data['user_role'] = $user->getRoleNames()[0];
                $data['user_role_name'] = ucwords(implode(' ', explode('-', $user->getRoleNames()[0])));

                return ApiResponse::success($data);
            } else {
                return ApiResponse::notFound('Data user tidak ditemukan.');
            }
        } catch (Exception $e) {
            return ApiResponse::badRequest($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|max:13',
                'username' => 'required|string|max:255|unique:users,username,' . $id,
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'password' => 'nullable|confirmed',
                'address' => 'required',
            ]);

            $data['IDPosko'] = isset($request->idPosko) ? $request->idPosko : null;

            // Cek jika password diisi, jika tidak unset dari $data
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            } else {
                unset($data['password']);
            }

            DB::beginTransaction();

            // Ambil user berdasarkan ID
            $user = User::findOrFail($id);

            // Update user dengan data yang sudah divalidasi
            $user_update = $user->update($data);

            /**
             * Validation Submit
             */
            if ($user_update) {
                // Perbarui role pengguna
                $roleName = Role::find($request->role)->name;
                $user->syncRoles([$roleName]); // Menghapus role lama dan menambahkan role baru
                $user_data = User::with(['roles'])->find($id);

                DB::commit();
                return ApiResponse::success($user_data);
            } else {
                DB::rollBack();
                return ApiResponse::badRequest('User Gagal Disimpan');
            }
        } catch (Exception $e) {
            return ApiResponse::success($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();

            User::where('id', $id)->update([
                'deleted_at' => Carbon::now(),
            ]);

            DB::commit();
            return ApiResponse::success('User berhasil dihapus');   
        } catch (Exception $e) {
            DB::rollBack();
            return ApiResponse::badRequest($e->getMessage());
        }
    }
}
