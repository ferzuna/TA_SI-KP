<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function mhspendaftaran(){
        return $this->hasOne(Pendaftaran::class, 'NIM', 'NIM')->latest();
    }
    public function mhspermohonan(){
        return $this->hasOne(Permohonan::class, 'NIM', 'NIM')->latest();
    }
    public function mhsbimbingan(){
        return $this->hasOne(Bimbingan::class, 'NIM', 'NIM')->latest();
    }
    public function mhspenilaian(){
        return $this->hasOne(Penilaian::class, 'NIM', 'NIM')->latest();
    }
    public function mhspenjadwalan(){
        return $this->hasOne(Penjadwalan::class, 'NIM', 'NIM')->latest();
    }

    public function dosenpendaftaran(){
        return $this->hasMany(Pendaftaran::class, 'NIP', 'NIP')->latest();
    }
    public function dosenbimbingan(){
        return $this->hasMany(Bimbingan::class, 'NIP', 'NIP')->latest();
    }
    public function dosenpenilaian(){
        return $this->hasMany(Penilaian::class, 'NIP', 'NIP')->latest();
    }
    public function dosenpenjadwalan(){
        return $this->hasMany(Penjadwalan::class, 'NIP', 'NIP')->latest();
    }

    
}
