<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUjianSiswaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'ujian_siswa';

    /**
     * Run the migrations.
     * @table Ujian_Siswa
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id');
            $table->primary('id');
            $table->text('random_soal')->nullable();
            $table->text('kunci_jawaban')->nullable();
            $table->text('random_jawaban')->nullable();
            $table->text('jawaban_siswa')->nullable();
            $table->dateTime('waktu_mulai')->nullable();
            $table->dateTime('waktu_selesai')->nullable();
            $table->integer('jumlah_benar')->nullable();
            $table->integer('jumlah_salah')->nullable();
            $table->integer('jumlah_kosong')->nullable();
            $table->text('nilai_uraian')->nullable();
            $table->string('status')->default(0);
            $table->string('keterangan')->default('Lancar');
            $table->char('paket_id', 36);
            $table->char('user_id', 36);
            $table->char('jadwal_ujian_id', 36);
            $table->timestamps();

            $table->index(["user_id"]);

            $table->index(["jadwal_ujian_id"]);

            $table->index(["paket_id"]);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
