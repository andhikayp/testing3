<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    /**
     * Config this model
     */
     protected $primaryKey='id';
     public $incrementing = false;

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'soal';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
    'id',
    'deskripsi',
    'pilihan_a',
    'pilihan_b',
    'pilihan_c',
    'pilihan_d',
    'pilihan_e',
    'kunci_jawaban',
    'tipe_soal',
    'bobot_essai',
    'tingkat_kesulitan',
    'level_kongnitif',
    'paket_id',    
    'anchor_number'
    ];

    /**
	 * One to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\hasMany
	 */
    public function latexs(){
        return $this->hasMany('App\Models\Latex');
    }

    /**
	 * One to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function paket(){
        return $this->belongsTo('App\Models\Paket');
    }

    public function jawabanEssai()
    {
        return $this->hasMany('App\Models\JawabanEssai');
    }

    public function users()
    {
        return $this->hasMany('App\Models\KorektorSoal');
    }

    public function correctionCounter() {
        return $this->belongsTo('App\Models\SoalCorrectionsCounter', 'id');
    }

    public function analisis() { 
        return $this->hasOne('App\Models\SoalAnalisis', 'id'); 
    }
}
