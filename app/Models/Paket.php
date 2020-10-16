<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{

    /**
     * Config this model
     * jika incrementing false maka kita pakai UUID
     */
     protected $primaryKey='id';
     public $incrementing = false;

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'paket';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
    'id',
    'nama',
    'deskripsi',
    'pelajaran_id'
    ];

    /**
	 * One to Many relation
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\hasMany
	 */
    public function soals(){
        return $this->hasMany('App\Models\Soal');
    }

    /**
	 * One to Many relation
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\hasMany
	 */
     public function ujianSiswas(){
        return $this->hasMany('App\Models\UjianSiswa');
    }

    /**
	 * One to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function pelajaran(){
        return $this->belongsTo('App\Models\Pelajaran');
    }

    public function jadwalujians(){
        return $this->belongsToMany('App\Models\JadwalUjian','ujian_paket')->withTimestamps();
    }
}
