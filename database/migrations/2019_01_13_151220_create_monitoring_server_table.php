<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonitoringServerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoring_server', function (Blueprint $table) {
            $table->increments('id');
            $table->char('sekolah_id',36)->nullable();
            $table->string('sekolah_nama')->nullable();
            $table->char('server_id',36)->nullable();
            $table->char('jadwal_ujian_id',36)->nullable();
            $table->string('deskripsi_jadwal')->nullable();
            $table->string('state')->nullable();
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
        Schema::dropIfExists('monitoring_server');
    }
}
