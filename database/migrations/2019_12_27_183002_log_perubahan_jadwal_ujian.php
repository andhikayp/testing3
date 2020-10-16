<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LogPerubahanJadwalUjian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_perubahan_jadwal_ujian', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('data_awal', 500);
            $table->string('data_baru', 500);
            $table->string('server_id');
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
        Schema::dropIfExists('log_perubahan_jadwal_ujian');
    }
}
