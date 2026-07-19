<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\Bantuan\Bantuan;
use App\Models\Barang\Barang;
use App\Models\DistribusiBantuan\DistribusiBantuan;
use App\Models\Kebutuhan\Kebutuhan;
use App\Models\Penduduk\Penduduk;
use App\Models\Pengungsi\Pengungsi;

class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('role:posko-utama|kecamatan|bansos');
    }

    public function index()
    {
        try {

            $data['distribusi_bantuan'] = DistribusiBantuan::whereNull('deleted_at')->whereNull('deleted_by')->count();
            $data['bantuan'] = Bantuan::whereNull('deleted_at')->whereNull('deleted_by')->count();
            $data['pengungsi'] = Pengungsi::whereNull('deleted_at')->whereNull('deleted_by')->count();
            $data['kebutuhan'] = Kebutuhan::whereNull('deleted_at')->whereNull('deleted_by')->count();
            $data['penduduk'] = Penduduk::whereNull('deleted_at')->whereNull('deleted_by')->count();
            $data['barang'] = Barang::whereNull('deleted_at')->whereNull('deleted_by')->count();

            return ApiResponse::success($data);
        } catch (\Throwable $th) {
            return ApiResponse::badRequest($th->getMessage());
        }
    }
}
