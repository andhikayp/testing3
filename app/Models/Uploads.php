<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uploads extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'uploads';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
    'id',
    'jenis',
    'nama_file',
    'path_file'
    ];

    public function sekolah(){
        return $this->belongsTo('App\Models\Sekolah');
    }

    public function jadwalUjian(){
        return $this->belongsTo('App\Models\JadwalUjian');
    }
}
