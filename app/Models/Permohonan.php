<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permohonan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];

    public function permohonanmhs(){
        return $this->hasOne(User::class, 'NIM', 'NIM');
    }

    public function permohonandosen(){
        return $this->hasOne(User::class, 'NIP', 'NIP');
    }
}
