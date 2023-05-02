<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfomagangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infomagangs', function (Blueprint $table) {
            $table->id();
            $table->string('perusahaan')->nullable();
            $table->string('posisi')->nullable();
            $table->string('durasi')->nullable();
            $table->string('requirement')->nullable();
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
        Schema::dropIfExists('infomagangs');
    }
}
