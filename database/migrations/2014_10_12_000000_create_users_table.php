<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('NIP')->unique()->nullable(); //dosen
            $table->string('NIM')->unique()->nullable(); //mahasiswa
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username');
            $table->string('password');
            $table->string('alamat')->nullable(); //dosen
            $table->integer('kuota_bimbingan')->nullable(); //dosen
            $table->integer('bobot_bimbingan')->nullable(); //dosen
            $table->string('angkatan')->nullable(); //mahasiswa
            $table->string('no_telp')->nullable(); //mahasiswa
            $table->string('sks')->nullable(); //mahasiswa
            $table->integer('role_id');
            $table->string('status')->nullable();
            $table->binary('image')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
