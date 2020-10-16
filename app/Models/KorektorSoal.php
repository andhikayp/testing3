<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KorektorSoal extends Model
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
    protected $table = 'korektor_soal';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
    'id',
    'soal_id',
    'user_id'
    ];

    public function pengkorektor()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function soalInfo()
    {
        $soal = Soal::find($this->soal_id);
        return $soal->deskripsi;
    }

    public function soal() {
        return $this->hasOne('App\Models\Soal', 'id', 'soal_id');
    }

    public function korektor_counter(){
        return $this->hasOne('App\Models\KorektorCounter', 'korektor_id', 'user_id');
    }
}
