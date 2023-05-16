<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penjadwalan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];

    public function penjadwalanmhs(){
        return $this->hasOne(User::class, 'NIM', 'NIM');
    }

    public function penjadwalandosen(){
        return $this->hasOne(User::class, 'NIP', 'NIP');
    }
}
