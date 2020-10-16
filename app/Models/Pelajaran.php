<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelajaran extends Model
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'pelajaran';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
    'id',
    'nama',
    'jenjang',
    'kurikulum'
    ];

    /**
	 * One to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\hasMany
	 */
    public function pakets(){
        return $this->hasMany('App\Models\Paket');
    }

    public function user(){
        return $this->hasMany('App\Models\User');
    }

    public function jadwals(){
        return $this->hasMany('App\Models\JadwalUjian');
    }
}
