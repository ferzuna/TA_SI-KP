<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pendaftaran extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];

    public function pendaftaranmhs(){
        return $this->hasOne(User::class, 'NIM', 'NIM');
    }

    public function pendaftarandosen(){
        return $this->hasOne(User::class, 'NIP', 'NIP');
    }
}
