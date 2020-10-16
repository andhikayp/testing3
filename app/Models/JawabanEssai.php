<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Soal;

class JawabanEssai extends Model
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
    protected $table = 'Jawaban_Essai';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
    'id',
    'soal_id',
    'ujian_siswa_id',
    'jawaban_siswa',
    'nilai',
    'user_id',
    'korektor_id'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pivot'
    ];

    public function ujianSiswa(){
        return $this->belongsTo('App\Models\UjianSiswa');
    }

    public function soal(){
        return $this->belongsTo('App\Models\Soal');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'koreksi')->withTimestamps();
    }
}
