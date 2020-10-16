<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDokumensTable extends Migration
{
    public $set_schema_table = 'dokumen';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->increments('id');
            $table->string('jenis');
            $table->string('file');
            $table->integer('sesi');
            $table->string('ruangan');
            $table->string('server');
            $table->integer('pelajaran_id');
            $table->char('sekolah_id', 36);
            $table->timestamps();

            $table->index(["pelajaran_id", "sekolah_id"]);
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
