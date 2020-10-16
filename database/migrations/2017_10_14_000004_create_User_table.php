<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'user';

    /**
     * Run the migrations.
     * @table User
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
            $table->string('nama')->nullable();
            $table->string('foto')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('nisn')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('password_siswa')->nullable();
            $table->string('password_korektor')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('level')->nullable();
            $table->string('nomer_peserta')->nullable();
            $table->string('agama')->nullable();
            $table->string('jenjang')->nullable();
            $table->string('jurusan')->nullable();
            $table->char('sekolah_id', 36)->nullable();
            $table->integer('pelajaran_id')->nullable();
            $table->timestamps();

            $table->index(["sekolah_id"]);
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
