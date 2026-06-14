<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\Menus\Menus;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['authenticate']]);
    }

    public function authenticate(Request $request)
    {
        try {
            // Filtering Username or Email
            $email_or_username = $request->input('email_or_username');
            $field = filter_var($email_or_username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            $request->merge([$field => $email_or_username]);

            $validator = Validator::make($request->all(), [
                $field => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return ApiResponse::badRequest(null, $validator->errors());
            }

            $credentials = request([$field, 'password']);

            if (!($token = auth()->guard('api')->attempt($credentials))) {
                return ApiResponse::unauthorized('Email atau Password Anda salah');
            }

            $role = auth()->guard('api')->user()->roles->pluck('name')[0] ?? null;

            return ApiResponse::success([
                'user' => auth()->guard('api')->user(),
                'role' => $role,
                'menus' => !is_null($role) ? Menus::where('Role', $role)->get() : [],
                'token' => $token,
            ]);
        } catch (\Exception $e) {
            return ApiResponse::badRequest(null, $e->getMessage());
        }
    }

    public function refresh()
    {
        return ApiResponse::success([
            'access_token' => auth()->refresh(),
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return ApiResponse::success(null, 'Logout Berhasil!');
    }
}
