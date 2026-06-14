<?php

namespace App\Models\Menus;

use App\Models\UserManagement\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    use HasFactory;

    protected $table = 'menus';
    protected $guarded = [];

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'RoleId');
    }
}
