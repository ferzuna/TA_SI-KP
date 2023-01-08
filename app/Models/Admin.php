<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

$role = Role::create(['name' => 'admin']);

class Admin extends Model
{
    use HasFactory;
    use HasRoles;
}
