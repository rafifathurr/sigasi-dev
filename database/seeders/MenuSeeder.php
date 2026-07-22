<?php

namespace Database\Seeders;

use App\Models\Menus\Menus;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Menus::insert(
            [
                //=== POSKO ROLES ===

                // DISTRIBUSI BANTUAN
                [
                    'MenuCode' => 'distribusi-bantuan',
                    'Role' => 'posko',
                    'Menu' => 'Distribusi Bantuan Index',
                    'Method' => 'GET',
                    'Url' => 'distribusi-bantuan',
                    'Sort' => 3,
                ],

                // KEBUTUHAN
                [
                    'MenuCode' => 'kebutuhan',
                    'Role' => 'posko',
                    'Menu' => 'Kebutuhan Index',
                    'Method' => 'GET',
                    'Url' => 'kebutuhan',
                    'Sort' => 2,
                ],
                [
                    'MenuCode' => 'kebutuhan',
                    'Role' => 'posko',
                    'Menu' => 'Kebutuhan Show',
                    'Method' => 'GET',
                    'Url' => 'kebutuhan/show',
                    'Sort' => 2,
                ],
                [
                    'MenuCode' => 'kebutuhan',
                    'Role' => 'posko',
                    'Menu' => 'Kebutuhan Store',
                    'Method' => 'POST',
                    'Url' => 'kebutuhan/store',
                    'Sort' => 2,
                ],
                [
                    'MenuCode' => 'kebutuhan',
                    'Role' => 'posko',
                    'Menu' => 'Kebutuhan Update',
                    'Method' => 'PUT',
                    'Url' => 'kebutuhan/update',
                    'Sort' => 2,
                ],
                [
                    'MenuCode' => 'kebutuhan',
                    'Role' => 'posko',
                    'Menu' => 'Kebutuhan Delete',
                    'Method' => 'DELETE',
                    'Url' => 'kebutuhan/delete',
                    'Sort' => 2,
                ],

                // PENGUNGSI
                [
                    'MenuCode' => 'pengungsi',
                    'Role' => 'posko',
                    'Menu' => 'Pengungsi Index',
                    'Method' => 'GET',
                    'Url' => 'pengungsi',
                    'Sort' => 1,
                ],
                [
                    'MenuCode' => 'pengungsi',
                    'Role' => 'posko',
                    'Menu' => 'Pengungsi Show',
                    'Method' => 'GET',
                    'Url' => 'pengungsi/show',
                    'Sort' => 1,
                ],
                [
                    'MenuCode' => 'pengungsi',
                    'Role' => 'posko',
                    'Menu' => 'Pengungsi Store',
                    'Method' => 'POST',
                    'Url' => 'pengungsi/store',
                    'Sort' => 1,
                ],
                [
                    'MenuCode' => 'pengungsi',
                    'Role' => 'posko',
                    'Menu' => 'Pengungsi Update',
                    'Method' => 'PUT',
                    'Url' => 'pengungsi/update',
                    'Sort' => 1,
                ],
                [
                    'MenuCode' => 'pengungsi',
                    'Role' => 'posko',
                    'Menu' => 'Pengungsi Delete',
                    'Method' => 'DELETE',
                    'Url' => 'pengungsi/delete',
                    'Sort' => 1,
                ],

                //=== POSKO UTAMA ===

                // DASHBOARD
                [
                    'MenuCode' => 'dashboard',
                    'Role' => 'posko-utama',
                    'Menu' => 'Dashboard Index',
                    'Method' => 'GET',
                    'Url' => 'dashboard',
                    'Sort' => 9,
                ],

                // DISTRIBUSI BANTUAN
                [
                    'MenuCode' => 'distribusi-bantuan',
                    'Role' => 'posko-utama',
                    'Menu' => 'Distribusi Bantuan Index',
                    'Method' => 'GET',
                    'Url' => 'distribusi-bantuan',
                    'Sort' => 8,
                ],

                // BANTUAN
                [
                    'MenuCode' => 'bantuan',
                    'Role' => 'posko-utama',
                    'Menu' => 'Bantuan Index',
                    'Method' => 'GET',
                    'Url' => 'bantuan',
                    'Sort' => 7,
                ],
                [
                    'MenuCode' => 'bantuan',
                    'Role' => 'posko-utama',
                    'Menu' => 'Bantuan Show',
                    'Method' => 'GET',
                    'Url' => 'bantuan/show',
                    'Sort' => 7,
                ],
                [
                    'MenuCode' => 'bantuan',
                    'Role' => 'posko-utama',
                    'Menu' => 'Bantuan Store',
                    'Method' => 'POST',
                    'Url' => 'bantuan/store',
                    'Sort' => 7,
                ],
                [
                    'MenuCode' => 'bantuan',
                    'Role' => 'posko-utama',
                    'Menu' => 'Bantuan Update',
                    'Method' => 'PUT',
                    'Url' => 'bantuan/update',
                    'Sort' => 7,
                ],
                [
                    'MenuCode' => 'bantuan',
                    'Role' => 'posko-utama',
                    'Menu' => 'Bantuan Delete',
                    'Method' => 'DELETE',
                    'Url' => 'bantuan/delete',
                    'Sort' => 7,
                ],

                // KEBUTUHAN
                [
                    'MenuCode' => 'kebutuhan',
                    'Role' => 'posko-utama',
                    'Menu' => 'Kebutuhan Index',
                    'Method' => 'GET',
                    'Url' => 'kebutuhan',
                    'Sort' => 6,
                ],
                [
                    'MenuCode' => 'kebutuhan',
                    'Role' => 'posko-utama',
                    'Menu' => 'Kebutuhan Show',
                    'Method' => 'GET',
                    'Url' => 'kebutuhan/show',
                    'Sort' => 6,
                ],
                [
                    'MenuCode' => 'kebutuhan',
                    'Role' => 'posko-utama',
                    'Menu' => 'Kebutuhan Store',
                    'Method' => 'POST',
                    'Url' => 'kebutuhan/store',
                    'Sort' => 6,
                ],
                [
                    'MenuCode' => 'kebutuhan',
                    'Role' => 'posko-utama',
                    'Menu' => 'Kebutuhan Update',
                    'Method' => 'PUT',
                    'Url' => 'kebutuhan/update',
                    'Sort' => 6,
                ],
                [
                    'MenuCode' => 'kebutuhan',
                    'Role' => 'posko-utama',
                    'Menu' => 'Kebutuhan Delete',
                    'Method' => 'DELETE',
                    'Url' => 'kebutuhan/delete',
                    'Sort' => 6,
                ],

                // PENGUNGSI
                [
                    'MenuCode' => 'pengungsi',
                    'Role' => 'posko-utama',
                    'Menu' => 'Pengungsi Index',
                    'Method' => 'GET',
                    'Url' => 'pengungsi',
                    'Sort' => 5,
                ],
                [
                    'MenuCode' => 'pengungsi',
                    'Role' => 'posko-utama',
                    'Menu' => 'Pengungsi Show',
                    'Method' => 'GET',
                    'Url' => 'pengungsi/show',
                    'Sort' => 5,
                ],
                [
                    'MenuCode' => 'pengungsi',
                    'Role' => 'posko-utama',
                    'Menu' => 'Pengungsi Store',
                    'Method' => 'POST',
                    'Url' => 'pengungsi/store',
                    'Sort' => 5,
                ],
                [
                    'MenuCode' => 'pengungsi',
                    'Role' => 'posko-utama',
                    'Menu' => 'Pengungsi Update',
                    'Method' => 'PUT',
                    'Url' => 'pengungsi/update',
                    'Sort' => 5,
                ],
                [
                    'MenuCode' => 'pengungsi',
                    'Role' => 'posko-utama',
                    'Menu' => 'Pengungsi Delete',
                    'Method' => 'DELETE',
                    'Url' => 'pengungsi/delete',
                    'Sort' => 5,
                ],

                // PENDUDUK
                [
                    'MenuCode' => 'penduduk',
                    'Role' => 'posko-utama',
                    'Menu' => 'Penduduk Index',
                    'Method' => 'GET',
                    'Url' => 'penduduk',
                    'Sort' => 4,
                ],
                [
                    'MenuCode' => 'penduduk',
                    'Role' => 'posko-utama',
                    'Menu' => 'Penduduk Show',
                    'Method' => 'GET',
                    'Url' => 'penduduk/show',
                    'Sort' => 4,
                ],
                [
                    'MenuCode' => 'penduduk',
                    'Role' => 'posko-utama',
                    'Menu' => 'Penduduk Store',
                    'Method' => 'POST',
                    'Url' => 'penduduk/store',
                    'Sort' => 4,
                ],
                [
                    'MenuCode' => 'penduduk',
                    'Role' => 'posko-utama',
                    'Menu' => 'Penduduk Update',
                    'Method' => 'PUT',
                    'Url' => 'penduduk/update',
                    'Sort' => 4,
                ],
                [
                    'MenuCode' => 'penduduk',
                    'Role' => 'posko-utama',
                    'Menu' => 'Penduduk Delete',
                    'Method' => 'DELETE',
                    'Url' => 'penduduk/delete',
                    'Sort' => 4,
                ],

                // POSKO
                [
                    'MenuCode' => 'posko',
                    'Role' => 'posko-utama',
                    'Menu' => 'Posko Index',
                    'Method' => 'GET',
                    'Url' => 'posko',
                    'Sort' => 3,
                ],
                [
                    'MenuCode' => 'posko',
                    'Role' => 'posko-utama',
                    'Menu' => 'Posko Store',
                    'Method' => 'POST',
                    'Url' => 'posko/store',
                    'Sort' => 3,
                ],
                [
                    'MenuCode' => 'posko',
                    'Role' => 'posko-utama',
                    'Menu' => 'Posko Show',
                    'Method' => 'GET',
                    'Url' => 'posko/show',
                    'Sort' => 3,
                ],
                [
                    'MenuCode' => 'posko',
                    'Role' => 'posko-utama',
                    'Menu' => 'Posko Update',
                    'Method' => 'PUT',
                    'Url' => 'posko/update',
                    'Sort' => 3,
                ],
                [
                    'MenuCode' => 'posko',
                    'Role' => 'posko-utama',
                    'Menu' => 'Posko Delete',
                    'Method' => 'DELETE',
                    'Url' => 'posko/delete',
                    'Sort' => 3,
                ],

                // USER MANAGEMENT
                [
                    'MenuCode' => 'user-management',
                    'Role' => 'posko-utama',
                    'Menu' => 'User Management Index',
                    'Method' => 'GET',
                    'Url' => 'user-management',
                    'Sort' => 2,
                ],
                [
                    'MenuCode' => 'user-management',
                    'Role' => 'posko-utama',
                    'Menu' => 'User Management Show',
                    'Method' => 'GET',
                    'Url' => 'user-management/show',
                    'Sort' => 2,
                ],
                [
                    'MenuCode' => 'user-management',
                    'Role' => 'posko-utama',
                    'Menu' => 'User Management Store',
                    'Method' => 'POST',
                    'Url' => 'user-management/store',
                    'Sort' => 2,
                ],
                [
                    'MenuCode' => 'user-management',
                    'Role' => 'posko-utama',
                    'Menu' => 'User Management Update',
                    'Method' => 'PUT',
                    'Url' => 'user-management/update',
                    'Sort' => 2,
                ],
                [
                    'MenuCode' => 'user-management',
                    'Role' => 'posko-utama',
                    'Menu' => 'User Management Delete',
                    'Method' => 'DELETE',
                    'Url' => 'user-management/delete',
                    'Sort' => 2,
                ],

                // LOG ACTIVITY
                [
                    'MenuCode' => 'log-activity',
                    'Role' => 'posko-utama',
                    'Menu' => 'Log Activity Index',
                    'Method' => 'GET',
                    'Url' => 'log-activity',
                    'Sort' => 1,
                ],

                //=== BANSOS ===

                // DASHBOARD
                [
                    'MenuCode' => 'dashboard',
                    'Role' => 'bansos',
                    'Menu' => 'Dashboard Index',
                    'Method' => 'GET',
                    'Url' => 'dashboard',
                    'Sort' => 3,
                ],

                // DISTRIBUSI BANTUAN
                [
                    'MenuCode' => 'distribusi-bantuan',
                    'Role' => 'bansos',
                    'Menu' => 'Distribusi Bantuan Index',
                    'Method' => 'GET',
                    'Url' => 'distribusi-bantuan',
                    'Sort' => 2,
                ],
                [
                    'MenuCode' => 'distribusi-bantuan',
                    'Role' => 'bansos',
                    'Menu' => 'Distribusi Bantuan Show',
                    'Method' => 'GET',
                    'Url' => 'distribusi-bantuan/show',
                    'Sort' => 2,
                ],
                [
                    'MenuCode' => 'distribusi-bantuan',
                    'Role' => 'bansos',
                    'Menu' => 'Distribusi Bantuan Store',
                    'Method' => 'POST',
                    'Url' => 'distribusi-bantuan/store',
                    'Sort' => 2,
                ],
                [
                    'MenuCode' => 'distribusi-bantuan',
                    'Role' => 'bansos',
                    'Menu' => 'Distribusi Bantuan Update',
                    'Method' => 'PUT',
                    'Url' => 'distribusi-bantuan/update',
                    'Sort' => 2,
                ],
                [
                    'MenuCode' => 'distribusi-bantuan',
                    'Role' => 'bansos',
                    'Menu' => 'Distribusi Bantuan Delete',
                    'Method' => 'DELETE',
                    'Url' => 'distribusi-bantuan/delete',
                    'Sort' => 2,
                ],

                // DONATUR
                [
                    'MenuCode' => 'donatur',
                    'Role' => 'bansos',
                    'Menu' => 'Donatur Index',
                    'Method' => 'GET',
                    'Url' => 'donatur',
                    'Sort' => 1,
                ],
                [
                    'MenuCode' => 'donatur',
                    'Role' => 'bansos',
                    'Menu' => 'Donatur Show',
                    'Method' => 'GET',
                    'Url' => 'donatur/show',
                    'Sort' => 1,
                ],
                [
                    'MenuCode' => 'donatur',
                    'Role' => 'bansos',
                    'Menu' => 'Donatur Store',
                    'Method' => 'POST',
                    'Url' => 'donatur/store',
                    'Sort' => 1,
                ],
                [
                    'MenuCode' => 'donatur',
                    'Role' => 'bansos',
                    'Menu' => 'Donatur Update',
                    'Method' => 'PUT',
                    'Url' => 'donatur/update',
                    'Sort' => 1,
                ],
                [
                    'MenuCode' => 'donatur',
                    'Role' => 'bansos',
                    'Menu' => 'Donatur Delete',
                    'Method' => 'DELETE',
                    'Url' => 'donatur/delete',
                    'Sort' => 1,
                ],

                //=== KECAMATAN ===

                // DASHBOARD
                [
                    'MenuCode' => 'dashboard',
                    'Role' => 'kecamatan',
                    'Menu' => 'Dashboard Index',
                    'Method' => 'GET',
                    'Url' => 'dashboard',
                    'Sort' => 8,
                ],

                // RENCANA ANGGARAN
                [
                    'MenuCode' => 'rencana-anggaran',
                    'Role' => 'kecamatan',
                    'Menu' => 'Rencana Anggaran Index',
                    'Method' => 'GET',
                    'Url' => 'rencana-anggaran',
                    'Sort' => 7,
                ],
                [
                    'MenuCode' => 'rencana-anggaran',
                    'Role' => 'kecamatan',
                    'Menu' => 'Rencana Anggaran Show',
                    'Method' => 'GET',
                    'Url' => 'rencana-anggaran/show',
                    'Sort' => 7,
                ],
                [
                    'MenuCode' => 'rencana-anggaran',
                    'Role' => 'kecamatan',
                    'Menu' => 'Rencana Anggaran Store',
                    'Method' => 'POST',
                    'Url' => 'rencana-anggaran/store',
                    'Sort' => 7,
                ],
                [
                    'MenuCode' => 'rencana-anggaran',
                    'Role' => 'kecamatan',
                    'Menu' => 'Rencana Anggaran Update',
                    'Method' => 'PUT',
                    'Url' => 'rencana-anggaran/update',
                    'Sort' => 7,
                ],
                [
                    'MenuCode' => 'rencana-anggaran',
                    'Role' => 'kecamatan',
                    'Menu' => 'Rencana Anggaran Delete',
                    'Method' => 'DELETE',
                    'Url' => 'rencana-anggaran/delete',
                    'Sort' => 7,
                ],

                // BANTUAN
                [
                    'MenuCode' => 'bantuan',
                    'Role' => 'kecamatan',
                    'Menu' => 'Bantuan Index',
                    'Method' => 'GET',
                    'Url' => 'bantuan',
                    'Sort' => 6,
                ],
                [
                    'MenuCode' => 'bantuan',
                    'Role' => 'kecamatan',
                    'Menu' => 'Bantuan Show',
                    'Method' => 'GET',
                    'Url' => 'bantuan/show',
                    'Sort' => 6,
                ],
                [
                    'MenuCode' => 'bantuan',
                    'Role' => 'kecamatan',
                    'Menu' => 'Bantuan Store',
                    'Method' => 'POST',
                    'Url' => 'bantuan/store',
                    'Sort' => 6,
                ],
                [
                    'MenuCode' => 'bantuan',
                    'Role' => 'kecamatan',
                    'Menu' => 'Bantuan Update',
                    'Method' => 'PUT',
                    'Url' => 'bantuan/update',
                    'Sort' => 6,
                ],
                [
                    'MenuCode' => 'bantuan',
                    'Role' => 'kecamatan',
                    'Menu' => 'Bantuan Delete',
                    'Method' => 'DELETE',
                    'Url' => 'bantuan/delete',
                    'Sort' => 6,
                ],

                // DONATUR
                [
                    'MenuCode' => 'donatur',
                    'Role' => 'kecamatan',
                    'Menu' => 'Donatur Index',
                    'Method' => 'GET',
                    'Url' => 'donatur',
                    'Sort' => 5,
                ],

                // PENDUDUK
                [
                    'MenuCode' => 'penduduk',
                    'Role' => 'kecamatan',
                    'Menu' => 'Penduduk Index',
                    'Method' => 'GET',
                    'Url' => 'penduduk',
                    'Sort' => 4,
                ],
                [
                    'MenuCode' => 'penduduk',
                    'Role' => 'kecamatan',
                    'Menu' => 'Penduduk Show',
                    'Method' => 'GET',
                    'Url' => 'penduduk/show',
                    'Sort' => 4,
                ],
                [
                    'MenuCode' => 'penduduk',
                    'Role' => 'kecamatan',
                    'Menu' => 'Penduduk Store',
                    'Method' => 'POST',
                    'Url' => 'penduduk/store',
                    'Sort' => 4,
                ],
                [
                    'MenuCode' => 'penduduk',
                    'Role' => 'kecamatan',
                    'Menu' => 'Penduduk Update',
                    'Method' => 'PUT',
                    'Url' => 'penduduk/update',
                    'Sort' => 4,
                ],
                [
                    'MenuCode' => 'penduduk',
                    'Role' => 'kecamatan',
                    'Menu' => 'Penduduk Delete',
                    'Method' => 'DELETE',
                    'Url' => 'penduduk/delete',
                    'Sort' => 4,
                ],

                // KELOMPOK
                [
                    'MenuCode' => 'kelompok',
                    'Role' => 'kecamatan',
                    'Menu' => 'Kelompok Index',
                    'Method' => 'GET',
                    'Url' => 'kelompok',
                    'Sort' => 3,
                ],
                [
                    'MenuCode' => 'kelompok',
                    'Role' => 'kecamatan',
                    'Menu' => 'Kelompok Show',
                    'Method' => 'GET',
                    'Url' => 'kelompok/show',
                    'Sort' => 3,
                ],
                [
                    'MenuCode' => 'kelompok',
                    'Role' => 'kecamatan',
                    'Menu' => 'Kelompok Store',
                    'Method' => 'POST',
                    'Url' => 'kelompok/store',
                    'Sort' => 3,
                ],
                [
                    'MenuCode' => 'kelompok',
                    'Role' => 'kecamatan',
                    'Menu' => 'Kelompok Update',
                    'Method' => 'PUT',
                    'Url' => 'kelompok/update',
                    'Sort' => 3,
                ],
                [
                    'MenuCode' => 'kelompok',
                    'Role' => 'kecamatan',
                    'Menu' => 'Kelompok Delete',
                    'Method' => 'DELETE',
                    'Url' => 'kelompok/delete',
                    'Sort' => 3,
                ],

                // BARANG
                [
                    'MenuCode' => 'barang',
                    'Role' => 'kecamatan',
                    'Menu' => 'Barang Index',
                    'Method' => 'GET',
                    'Url' => 'barang',
                    'Sort' => 2,
                ],
                [
                    'MenuCode' => 'barang',
                    'Role' => 'kecamatan',
                    'Menu' => 'Barang Show',
                    'Method' => 'GET',
                    'Url' => 'barang/show',
                    'Sort' => 2,
                ],
                [
                    'MenuCode' => 'barang',
                    'Role' => 'kecamatan',
                    'Menu' => 'Barang Store',
                    'Method' => 'POST',
                    'Url' => 'barang/store',
                    'Sort' => 2,
                ],
                [
                    'MenuCode' => 'barang',
                    'Role' => 'kecamatan',
                    'Menu' => 'Barang Update',
                    'Method' => 'PUT',
                    'Url' => 'barang/update',
                    'Sort' => 2,
                ],
                [
                    'MenuCode' => 'barang',
                    'Role' => 'kecamatan',
                    'Menu' => 'Barang Delete',
                    'Method' => 'DELETE',
                    'Url' => 'barang/delete',
                    'Sort' => 2,
                ],

                // JENIS BARANG
                [
                    'MenuCode' => 'jenis-barang',
                    'Role' => 'kecamatan',
                    'Menu' => 'Jenis Barang Index',
                    'Method' => 'GET',
                    'Url' => 'jenis-barang',
                    'Sort' => 1,
                ],
                [
                    'MenuCode' => 'jenis-barang',
                    'Role' => 'kecamatan',
                    'Menu' => 'Jenis Barang Show',
                    'Method' => 'GET',
                    'Url' => 'jenis-barang/show',
                    'Sort' => 1,
                ],
                [
                    'MenuCode' => 'jenis-barang',
                    'Role' => 'kecamatan',
                    'Menu' => 'Jenis Barang Store',
                    'Method' => 'POST',
                    'Url' => 'jenis-barang/store',
                    'Sort' => 1,
                ],
                [
                    'MenuCode' => 'jenis-barang',
                    'Role' => 'kecamatan',
                    'Menu' => 'Jenis Barang Update',
                    'Method' => 'PUT',
                    'Url' => 'jenis-barang/update',
                    'Sort' => 1,
                ],
                [
                    'MenuCode' => 'jenis-barang',
                    'Role' => 'kecamatan',
                    'Menu' => 'Jenis Barang Delete',
                    'Method' => 'DELETE',
                    'Url' => 'jenis-barang/delete',
                    'Sort' => 1,
                ],
            ]
        );
    }
}
