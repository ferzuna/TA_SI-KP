<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->string('NIP')->length(20);
            $table->string('NIM')->length(20);
            $table->string('kehadiran')->nullable();
            $table->string('a2')->nullable();
            $table->string('b4')->nullable();
            $table->string('b5')->nullable();
            $table->string('status')->nullable()->length(15);
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
        Schema::dropIfExists('penilaians');
    }
}
