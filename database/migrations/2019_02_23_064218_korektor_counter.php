<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KorektorCounter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('korektor_counter', function(Blueprint $table) {
            $table->engine = 'MEMORY';
            $table->char('korektor_id', 36);
            $table->primary('korektor_id');
            $table->integer('essays_assigned_count');
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
        Schema::dropIfExists('korektor_counter');
    }
}
