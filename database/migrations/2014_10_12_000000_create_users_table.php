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
            $table->string('NIP')->unique()->nullable()->length(20); //dosen
            $table->string('NIM')->unique()->nullable()->length(20); //mahasiswa
            $table->string('name')->length(50);
            $table->string('email')->unique();
            $table->string('username')->unique()->nullable()->length(25);
            $table->string('password');
            $table->string('alamat')->nullable()->length(50); //dosen
            $table->integer('kuota_bimbingan')->nullable(); //dosen
            $table->integer('bobot_bimbingan')->nullable(); //dosen
            $table->string('semester')->nullable()->length(2); //mahasiswa
            $table->string('no_telp')->nullable()->length(20); //mahasiswa
            $table->string('sks')->nullable()->length(4); //mahasiswa
            $table->integer('role_id');
            $table->string('status')->nullable()->length(20);
            $table->binary('image')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->softDeletes();
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
