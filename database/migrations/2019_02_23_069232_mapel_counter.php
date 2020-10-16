<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MapelCounter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('soal_corrections_counter', function(Blueprint $table) {
            $table->engine = 'MEMORY';
            $table->char('soal_id', 36);
            $table->primary('soal_id');
            $table->integer('essays_total_count');
            $table->integer('essays_corrected_count');
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
        Schema::dropIfExists('soal_corrections_counter');

    }
}
