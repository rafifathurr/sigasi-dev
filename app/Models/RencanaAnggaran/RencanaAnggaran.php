<?php

namespace App\Models\RencanaAnggaran;

use App\Models\Bantuan\Bantuan;
use App\Models\Posko\Posko;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaAnggaran extends Model
{
    use HasFactory;

    protected $table = 'rencana_anggaran';
    protected $primaryKey = 'IDRencanaAnggaran';
    protected $guarded = [];
    public $timestamps = false;

    public function rencanaAnggaranItems()
    {
        return $this->hasMany(RencanaAnggaranItems::class, 'IDRencanaAnggaran', 'IDRencanaAnggaran');
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
