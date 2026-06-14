<?php

namespace App\Http\Controllers\Api\LogActivity;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\LogActivity\LogActivity;
use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('role:posko-utama');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if (isset($request->all) && $request->all) {
                return ApiResponse::success(LogActivity::with('user')->orderBy('IDLogActivity', 'DESC')->get());
            }

            // Mengembalikan response sukses dengan data Log Activity
            return ApiResponse::success(LogActivity::with('user')->orderBy('IDLogActivity', 'DESC')->paginate(10));
        } catch (\Throwable $th) {
            // Menangkap exception dan mengembalikan pesan error
            return ApiResponse::badRequest($th->getMessage());
        }
    }
}
