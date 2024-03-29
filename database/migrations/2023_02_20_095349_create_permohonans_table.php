<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonans', function (Blueprint $table) {
            $table->id();
            $table->string('NIM')->length(20);
            $table->string('email')->length(100);
            $table->string('perusahaan')->nullable()->length(50);
            $table->string('proposal')->nullable();
            $table->string('alamatins')->nullable()->length(75);
            $table->boolean('status')->nullable();
            $table->date('mulai')->nullable();
            $table->date('selesai')->nullable();
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
        Schema::dropIfExists('permohonans');
    }
}
