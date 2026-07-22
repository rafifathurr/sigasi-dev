<?php

namespace App\Models\RencanaAnggaran;

use App\Models\Bantuan\Bantuan;
use App\Models\Barang\Barang;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaAnggaranItems extends Model
{
    use HasFactory;

    protected $table = 'rencana_anggaran_items';
    protected $primaryKey = 'IDRencanaAnggaranItems';
    protected $guarded = [];
    public $timestamps = false;

    public function rencanaAnggaran()
    {
        return $this->hasOne(RencanaAnggaran::class, 'IDRencanaAnggaran', 'IDRencanaAnggaran');
    }

    public function barang()
    {
        return $this->hasOne(Barang::class, 'IDBarang', 'IDBarang');
    }

    public function bantuan()
    {
        return $this->hasOne(Bantuan::class, 'IDBantuan', 'IDBantuan');
    }

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function updatedBy()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }

    public function deletedBy()
    {
        return $this->hasOne(User::class, 'id', 'deleted_by');
    }
}
