<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoalTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'soal';

    /**
     * Run the migrations.
     * @table Soal
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
            $table->longText('deskripsi')->nullable();
            $table->longText('pilihan_a')->nullable();
            $table->longText('pilihan_b')->nullable();
            $table->longText('pilihan_c')->nullable();
            $table->longText('pilihan_d')->nullable();
            $table->longText('pilihan_e')->nullable();
            $table->longText('kunci_jawaban')->nullable();
            $table->integer('tingkat_kesulitan')->nullable();
            $table->string('level_kongnitif')->nullable();
            $table->char('paket_id', 36);
            $table->string('tipe_soal')->nullable();            
            $table->integer('anchor_number')->default(0); //new property to set what number soal is
            $table->timestamps();

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
