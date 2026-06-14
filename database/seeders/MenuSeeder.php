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
                ],

                // KEBUTUHAN
                [
                    'MenuCode' => 'kebutuhan',
                    'Role' => 'posko',
                    'Menu' => 'Kebutuhan Index',
                    'Method' => 'GET',
                    'Url' => 'kebutuhan',
                ],
                [
                    'MenuCode' => 'kebutuhan',
                    'Role' => 'posko',
                    'Menu' => 'Kebutuhan Show',
                    'Method' => 'GET',
                    'Url' => 'kebutuhan/show',
                ],
                [
                    'MenuCode' => 'kebutuhan',
                    'Role' => 'posko',
                    'Menu' => 'Kebutuhan Store',
                    'Method' => 'POST',
                    'Url' => 'kebutuhan/store',
                ],
                [
                    'MenuCode' => 'kebutuhan',
                    'Role' => 'posko',
                    'Menu' => 'Kebutuhan Update',
                    'Method' => 'PUT',
                    'Url' => 'kebutuhan/update',
                ],
                [
                    'MenuCode' => 'kebutuhan',
                    'Role' => 'posko',
                    'Menu' => 'Kebutuhan Delete',
                    'Method' => 'DELETE',
                    'Url' => 'kebutuhan/delete',
                ],

                // PENGUNGSI
                [
                    'MenuCode' => 'pengungsi',
                    'Role' => 'posko',
                    'Menu' => 'Pengungsi Index',
                    'Method' => 'GET',
                    'Url' => 'pengungsi',
                ],
                [
                    'MenuCode' => 'pengungsi',
                    'Role' => 'posko',
                    'Menu' => 'Pengungsi Show',
                    'Method' => 'GET',
                    'Url' => 'pengungsi/show',
                ],
                [
                    'MenuCode' => 'pengungsi',
                    'Role' => 'posko',
                    'Menu' => 'Pengungsi Store',
                    'Method' => 'POST',
                    'Url' => 'pengungsi/store',
                ],
                [
                    'MenuCode' => 'pengungsi',
                    'Role' => 'posko',
                    'Menu' => 'Pengungsi Update',
                    'Method' => 'PUT',
                    'Url' => 'pengungsi/update',
                ],
                [
                    'MenuCode' => 'pengungsi',
                    'Role' => 'posko',
                    'Menu' => 'Pengungsi Delete',
                    'Method' => 'DELETE',
                    'Url' => 'pengungsi/delete',
                ],

                //=== POSKO UTAMA ===

                // DASHBOARD
                [
                    'MenuCode' => 'dashboard',
                    'Role' => 'posko-utama',
                    'Menu' => 'Dashboard Index',
                    'Method' => 'GET',
                    'Url' => 'dashboard',
                ],

                // DISTRIBUSI BANTUAN
                [
                    'MenuCode' => 'distribusi-bantuan',
                    'Role' => 'posko-utama',
                    'Menu' => 'Distribusi Bantuan Index',
                    'Method' => 'GET',
                    'Url' => 'distribusi-bantuan',
                ],

                // BANTUAN
                [
                    'MenuCode' => 'bantuan',
                    'Role' => 'posko-utama',
                    'Menu' => 'Bantuan Index',
                    'Method' => 'GET',
                    'Url' => 'bantuan',
                ],
                [
                    'MenuCode' => 'bantuan',
                    'Role' => 'posko-utama',
                    'Menu' => 'Bantuan Show',
                    'Method' => 'GET',
                    'Url' => 'bantuan/show',
                ],
                [
                    'MenuCode' => 'bantuan',
                    'Role' => 'posko-utama',
                    'Menu' => 'Bantuan Store',
                    'Method' => 'POST',
                    'Url' => 'bantuan/store',
                ],
                [
                    'MenuCode' => 'bantuan',
                    'Role' => 'posko-utama',
                    'Menu' => 'Bantuan Update',
                    'Method' => 'PUT',
                    'Url' => 'bantuan/update',
                ],
                [
                    'MenuCode' => 'bantuan',
                    'Role' => 'posko-utama',
                    'Menu' => 'Bantuan Delete',
                    'Method' => 'DELETE',
                    'Url' => 'bantuan/delete',
                ],

                // KEBUTUHAN
                [
                    'MenuCode' => 'kebutuhan',
                    'Role' => 'posko-utama',
                    'Menu' => 'Kebutuhan Index',
                    'Method' => 'GET',
                    'Url' => 'kebutuhan',
                ],
                [
                    'MenuCode' => 'kebutuhan',
                    'Role' => 'posko-utama',
                    'Menu' => 'Kebutuhan Show',
                    'Method' => 'GET',
                    'Url' => 'kebutuhan/show',
                ],
                [
                    'MenuCode' => 'kebutuhan',
                    'Role' => 'posko-utama',
                    'Menu' => 'Kebutuhan Store',
                    'Method' => 'POST',
                    'Url' => 'kebutuhan/store',
                ],
                [
                    'MenuCode' => 'kebutuhan',
                    'Role' => 'posko-utama',
                    'Menu' => 'Kebutuhan Update',
                    'Method' => 'PUT',
                    'Url' => 'kebutuhan/update',
                ],
                [
                    'MenuCode' => 'kebutuhan',
                    'Role' => 'posko-utama',
                    'Menu' => 'Kebutuhan Delete',
                    'Method' => 'DELETE',
                    'Url' => 'kebutuhan/delete',
                ],

                // PENGUNGSI
                [
                    'MenuCode' => 'pengungsi',
                    'Role' => 'posko-utama',
                    'Menu' => 'Pengungsi Index',
                    'Method' => 'GET',
                    'Url' => 'pengungsi',
                ],
                [
                    'MenuCode' => 'pengungsi',
                    'Role' => 'posko-utama',
                    'Menu' => 'Pengungsi Show',
                    'Method' => 'GET',
                    'Url' => 'pengungsi/show',
                ],
                [
                    'MenuCode' => 'pengungsi',
                    'Role' => 'posko-utama',
                    'Menu' => 'Pengungsi Store',
                    'Method' => 'POST',
                    'Url' => 'pengungsi/store',
                ],
                [
                    'MenuCode' => 'pengungsi',
                    'Role' => 'posko-utama',
                    'Menu' => 'Pengungsi Update',
                    'Method' => 'PUT',
                    'Url' => 'pengungsi/update',
                ],
                [
                    'MenuCode' => 'pengungsi',
                    'Role' => 'posko-utama',
                    'Menu' => 'Pengungsi Delete',
                    'Method' => 'DELETE',
                    'Url' => 'pengungsi/delete',
                ],

                // PENDUDUK
                [
                    'MenuCode' => 'penduduk',
                    'Role' => 'posko-utama',
                    'Menu' => 'Penduduk Index',
                    'Method' => 'GET',
                    'Url' => 'penduduk',
                ],
                [
                    'MenuCode' => 'penduduk',
                    'Role' => 'posko-utama',
                    'Menu' => 'Penduduk Show',
                    'Method' => 'GET',
                    'Url' => 'penduduk/show',
                ],
                [
                    'MenuCode' => 'penduduk',
                    'Role' => 'posko-utama',
                    'Menu' => 'Penduduk Store',
                    'Method' => 'POST',
                    'Url' => 'penduduk/store',
                ],
                [
                    'MenuCode' => 'penduduk',
                    'Role' => 'posko-utama',
                    'Menu' => 'Penduduk Update',
                    'Method' => 'PUT',
                    'Url' => 'penduduk/update',
                ],
                [
                    'MenuCode' => 'penduduk',
                    'Role' => 'posko-utama',
                    'Menu' => 'Penduduk Delete',
                    'Method' => 'DELETE',
                    'Url' => 'penduduk/delete',
                ],

                // POSKO
                [
                    'MenuCode' => 'posko',
                    'Role' => 'posko-utama',
                    'Menu' => 'Posko Index',
                    'Method' => 'GET',
                    'Url' => 'posko',
                ],
                [
                    'MenuCode' => 'posko',
                    'Role' => 'posko-utama',
                    'Menu' => 'Posko Store',
                    'Method' => 'POST',
                    'Url' => 'posko/store',
                ],
                [
                    'MenuCode' => 'posko',
                    'Role' => 'posko-utama',
                    'Menu' => 'Posko Show',
                    'Method' => 'GET',
                    'Url' => 'posko/show',
                ],
                [
                    'MenuCode' => 'posko',
                    'Role' => 'posko-utama',
                    'Menu' => 'Posko Update',
                    'Method' => 'PUT',
                    'Url' => 'posko/update',
                ],
                [
                    'MenuCode' => 'posko',
                    'Role' => 'posko-utama',
                    'Menu' => 'Posko Delete',
                    'Method' => 'DELETE',
                    'Url' => 'posko/delete',
                ],

                // USER MANAGEMENT
                [
                    'MenuCode' => 'user-management',
                    'Role' => 'posko-utama',
                    'Menu' => 'User Management Index',
                    'Method' => 'GET',
                    'Url' => 'user-management',
                ],
                [
                    'MenuCode' => 'user-management',
                    'Role' => 'posko-utama',
                    'Menu' => 'User Management Show',
                    'Method' => 'GET',
                    'Url' => 'user-management/show',
                ],
                [
                    'MenuCode' => 'user-management',
                    'Role' => 'posko-utama',
                    'Menu' => 'User Management Store',
                    'Method' => 'POST',
                    'Url' => 'user-management/store',
                ],
                [
                    'MenuCode' => 'user-management',
                    'Role' => 'posko-utama',
                    'Menu' => 'User Management Update',
                    'Method' => 'PUT',
                    'Url' => 'user-management/update',
                ],
                [
                    'MenuCode' => 'user-management',
                    'Role' => 'posko-utama',
                    'Menu' => 'User Management Delete',
                    'Method' => 'DELETE',
                    'Url' => 'user-management/delete',
                ],

                // LOG ACTIVITY
                [
                    'MenuCode' => 'log-activity',
                    'Role' => 'posko-utama',
                    'Menu' => 'Log Activity Index',
                    'Method' => 'GET',
                    'Url' => 'log-activity',
                ],

                //=== BANSOS ===

                // DASHBOARD
                [
                    'MenuCode' => 'dashboard',
                    'Role' => 'bansos',
                    'Menu' => 'Dashboard Index',
                    'Method' => 'GET',
                    'Url' => 'dashboard',
                ],

                // DISTRIBUSI BANTUAN
                [
                    'MenuCode' => 'distribusi-bantuan',
                    'Role' => 'bansos',
                    'Menu' => 'Distribusi Bantuan Index',
                    'Method' => 'GET',
                    'Url' => 'distribusi-bantuan',
                ],
                [
                    'MenuCode' => 'distribusi-bantuan',
                    'Role' => 'bansos',
                    'Menu' => 'Distribusi Bantuan Show',
                    'Method' => 'GET',
                    'Url' => 'distribusi-bantuan/show',
                ],
                [
                    'MenuCode' => 'distribusi-bantuan',
                    'Role' => 'bansos',
                    'Menu' => 'Distribusi Bantuan Store',
                    'Method' => 'POST',
                    'Url' => 'distribusi-bantuan/store',
                ],
                [
                    'MenuCode' => 'distribusi-bantuan',
                    'Role' => 'bansos',
                    'Menu' => 'Distribusi Bantuan Update',
                    'Method' => 'PUT',
                    'Url' => 'distribusi-bantuan/update',
                ],
                [
                    'MenuCode' => 'distribusi-bantuan',
                    'Role' => 'bansos',
                    'Menu' => 'Distribusi Bantuan Delete',
                    'Method' => 'DELETE',
                    'Url' => 'distribusi-bantuan/delete',
                ],

                // DONATUR
                [
                    'MenuCode' => 'donatur',
                    'Role' => 'bansos',
                    'Menu' => 'Donatur Index',
                    'Method' => 'GET',
                    'Url' => 'donatur',
                ],
                [
                    'MenuCode' => 'donatur',
                    'Role' => 'bansos',
                    'Menu' => 'Donatur Show',
                    'Method' => 'GET',
                    'Url' => 'donatur/show',
                ],
                [
                    'MenuCode' => 'donatur',
                    'Role' => 'bansos',
                    'Menu' => 'Donatur Store',
                    'Method' => 'POST',
                    'Url' => 'donatur/store',
                ],
                [
                    'MenuCode' => 'donatur',
                    'Role' => 'bansos',
                    'Menu' => 'Donatur Update',
                    'Method' => 'PUT',
                    'Url' => 'donatur/update',
                ],
                [
                    'MenuCode' => 'donatur',
                    'Role' => 'bansos',
                    'Menu' => 'Donatur Delete',
                    'Method' => 'DELETE',
                    'Url' => 'donatur/delete',
                ],

                //=== KECAMATAN ===

                // DASHBOARD
                [
                    'MenuCode' => 'dashboard',
                    'Role' => 'kecamatan',
                    'Menu' => 'Dashboard Index',
                    'Method' => 'GET',
                    'Url' => 'dashboard',
                ],

                // BANTUAN
                [
                    'MenuCode' => 'bantuan',
                    'Role' => 'kecamatan',
                    'Menu' => 'Bantuan Index',
                    'Method' => 'GET',
                    'Url' => 'bantuan',
                ],
                [
                    'MenuCode' => 'bantuan',
                    'Role' => 'kecamatan',
                    'Menu' => 'Bantuan Show',
                    'Method' => 'GET',
                    'Url' => 'bantuan/show',
                ],
                [
                    'MenuCode' => 'bantuan',
                    'Role' => 'kecamatan',
                    'Menu' => 'Bantuan Store',
                    'Method' => 'POST',
                    'Url' => 'bantuan/store',
                ],
                [
                    'MenuCode' => 'bantuan',
                    'Role' => 'kecamatan',
                    'Menu' => 'Bantuan Update',
                    'Method' => 'PUT',
                    'Url' => 'bantuan/update',
                ],
                [
                    'MenuCode' => 'bantuan',
                    'Role' => 'kecamatan',
                    'Menu' => 'Bantuan Delete',
                    'Method' => 'DELETE',
                    'Url' => 'bantuan/delete',
                ],

                // DONATUR
                [
                    'MenuCode' => 'donatur',
                    'Role' => 'kecamatan',
                    'Menu' => 'Donatur Index',
                    'Method' => 'GET',
                    'Url' => 'donatur',
                ],

                // PENDUDUK
                [
                    'MenuCode' => 'penduduk',
                    'Role' => 'kecamatan',
                    'Menu' => 'Penduduk Index',
                    'Method' => 'GET',
                    'Url' => 'penduduk',
                ],
                [
                    'MenuCode' => 'penduduk',
                    'Role' => 'kecamatan',
                    'Menu' => 'Penduduk Show',
                    'Method' => 'GET',
                    'Url' => 'penduduk/show',
                ],
                [
                    'MenuCode' => 'penduduk',
                    'Role' => 'kecamatan',
                    'Menu' => 'Penduduk Store',
                    'Method' => 'POST',
                    'Url' => 'penduduk/store',
                ],
                [
                    'MenuCode' => 'penduduk',
                    'Role' => 'kecamatan',
                    'Menu' => 'Penduduk Update',
                    'Method' => 'PUT',
                    'Url' => 'penduduk/update',
                ],
                [
                    'MenuCode' => 'penduduk',
                    'Role' => 'kecamatan',
                    'Menu' => 'Penduduk Delete',
                    'Method' => 'DELETE',
                    'Url' => 'penduduk/delete',
                ],

                // KELOMPOK
                [
                    'MenuCode' => 'kelompok',
                    'Role' => 'kecamatan',
                    'Menu' => 'Kelompok Index',
                    'Method' => 'GET',
                    'Url' => 'kelompok',
                ],
                [
                    'MenuCode' => 'kelompok',
                    'Role' => 'kecamatan',
                    'Menu' => 'Kelompok Show',
                    'Method' => 'GET',
                    'Url' => 'kelompok/show',
                ],
                [
                    'MenuCode' => 'kelompok',
                    'Role' => 'kecamatan',
                    'Menu' => 'Kelompok Store',
                    'Method' => 'POST',
                    'Url' => 'kelompok/store',
                ],
                [
                    'MenuCode' => 'kelompok',
                    'Role' => 'kecamatan',
                    'Menu' => 'Kelompok Update',
                    'Method' => 'PUT',
                    'Url' => 'kelompok/update',
                ],
                [
                    'MenuCode' => 'kelompok',
                    'Role' => 'kecamatan',
                    'Menu' => 'Kelompok Delete',
                    'Method' => 'DELETE',
                    'Url' => 'kelompok/delete',
                ],

                // BARANG
                [
                    'MenuCode' => 'barang',
                    'Role' => 'kecamatan',
                    'Menu' => 'Barang Index',
                    'Method' => 'GET',
                    'Url' => 'barang',
                ],
                [
                    'MenuCode' => 'barang',
                    'Role' => 'kecamatan',
                    'Menu' => 'Barang Show',
                    'Method' => 'GET',
                    'Url' => 'barang/show',
                ],
                [
                    'MenuCode' => 'barang',
                    'Role' => 'kecamatan',
                    'Menu' => 'Barang Store',
                    'Method' => 'POST',
                    'Url' => 'barang/store',
                ],
                [
                    'MenuCode' => 'barang',
                    'Role' => 'kecamatan',
                    'Menu' => 'Barang Update',
                    'Method' => 'PUT',
                    'Url' => 'barang/update',
                ],
                [
                    'MenuCode' => 'barang',
                    'Role' => 'kecamatan',
                    'Menu' => 'Barang Delete',
                    'Method' => 'DELETE',
                    'Url' => 'barang/delete',
                ],

                // JENIS BARANG
                [
                    'MenuCode' => 'jenis-barang',
                    'Role' => 'kecamatan',
                    'Menu' => 'Jenis Barang Index',
                    'Method' => 'GET',
                    'Url' => 'jenis-barang',
                ],
                [
                    'MenuCode' => 'jenis-barang',
                    'Role' => 'kecamatan',
                    'Menu' => 'Jenis Barang Show',
                    'Method' => 'GET',
                    'Url' => 'jenis-barang/show',
                ],
                [
                    'MenuCode' => 'jenis-barang',
                    'Role' => 'kecamatan',
                    'Menu' => 'Jenis Barang Store',
                    'Method' => 'POST',
                    'Url' => 'jenis-barang/store',
                ],
                [
                    'MenuCode' => 'jenis-barang',
                    'Role' => 'kecamatan',
                    'Menu' => 'Jenis Barang Update',
                    'Method' => 'PUT',
                    'Url' => 'jenis-barang/update',
                ],
                [
                    'MenuCode' => 'jenis-barang',
                    'Role' => 'kecamatan',
                    'Menu' => 'Jenis Barang Delete',
                    'Method' => 'DELETE',
                    'Url' => 'jenis-barang/delete',
                ],
            ]
        );
    }
}
