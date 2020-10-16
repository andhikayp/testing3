<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalUjian extends Model
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
    protected $table = 'jadwal_ujian';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
    'id',
    'deskripsi',
    'sesi',
    'waktu_mulai',
    'waktu_selesai',
    'durasi',
    'tipe_ujian',
    'pelajaran_id'
    ];

    /**
	 * One to Many relation
	 * 
	 * @return Illuminate\Database\Eloquent\Relations\hasMany
	 */
     public function ujianSiswas(){
        return $this->hasMany('App\Models\UjianSiswa');
    }

    public function uploads(){
        return $this->hasMany('App\Models\Uploads');
    }

    public function pakets(){
        return $this->belongsToMany('App\Models\Paket','ujian_paket')->withTimestamps();
    }

    public function jawabanEssai()
    {
        return $this->hasManyThrough('App\Models\JawabanEssai', 'App\Models\UjianSiswa', 'jadwal_ujian_id', 'ujian_siswa_id', 'id', 'id');
    }

    public function encryption_key()
    {
        return $this->hasOne('App\Models\EncryptionKey');
    }

    public function pelajaran()
    {
        return $this->belongsTo('App\Models\Pelajaran');
    }
}
