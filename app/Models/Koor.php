<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;


class Koor extends Model
{
    use HasFactory;
    use HasRoles;

    protected $guarded = ['id'];
}
