<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class Mahasiswa extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasFactory, HasRoles;

    protected $guarded = ['id'];

    // protected $fillable = [
    //     'NIM',
    //     'nama'
    // ]
}
