<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjadwalansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjadwalans', function (Blueprint $table) {
            $table->id();
            $table->string('NIP')->length(20);
            $table->string('NIM')->length(20);
            $table->string('ruangan')->nullable()->length(15);
            $table->string('kehadiran')->nullable();
            $table->string('survey')->nullable();
            $table->dateTime('jadwal')->nullable();
            $table->string('status')->nullable()->length(2);
            $table->softDeletes();
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
        Schema::dropIfExists('penjadwalans');
    }
}
