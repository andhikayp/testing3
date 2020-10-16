<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UjianSiswa extends Model
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
    protected $table = 'ujian_siswa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
    'id',
    'random_soal',
    'random_jawaban',
    'jawaban_siswa',
    'waktu_mulai',
    'waktu_selesai',
    'jumlah_benar',
    'jumlah_salah',
    'jumlah_kosong',
    'nilai_uraian',
    'paket_id',
    'user_id',
    'server_id',
    'jadwal_ujian_id'
    ];

    /**
	 * One to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
     public function server(){
        return $this->belongsTo('App\Models\Server');
    }

    /**
	 * One to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
     public function user(){
        return $this->belongsTo('App\Models\User');
    }
    
    /**
	 * One to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
     public function jadwalUjian(){
        return $this->belongsTo('App\Models\JadwalUjian');
    }

    /**
	 * One to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
     public function jawabanEssai(){
        return $this->hasMany('App\Models\JawabanEssai');
    }

    public function paket(){
        return $this->belongsTo('App\Models\Paket');
    }

    public function soal($id)
    {
        $soal = Soal::find($id);
        return $soal;
    }

}
