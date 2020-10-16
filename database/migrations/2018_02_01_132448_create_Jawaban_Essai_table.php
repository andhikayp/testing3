<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJawabanEssaiTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Jawaban_Essai';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create('Jawaban_Essai', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->text('jawaban_siswa')->nullable();
            $table->string('nilai')->nullable();
            $table->char('ujian_siswa_id',36)->nullable();
            $table->char('soal_id',36)->nullable();
            $table->char('paket_id',36)->nullable();
            $table->char('user_id',36)->nullable();
            $table->char('korektor_id',36)->nullable();
            $table->string('jadwal_ujian_id',100)->nullable();

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
        Schema::dropIfExists($this->set_schema_table);
    }
}
