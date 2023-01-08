<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

$role = Role::create(['name' => 'mahasiswa']);

class Mahasiswa extends Model
{
    use HasFactory;
    use HasRoles;

    protected $guarded = ['id'];
}
