<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
    protected $table = 'user';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'nama',
        'foto',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'nisn',
        'username',
        'password',
        'level',
        'sekolah_id',
        'pelajaran_id',
        'password_korektor'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'pivot'
    ];

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
    public function sekolah(){
        return $this->belongsTo('App\Models\Sekolah');
    }

    public function ujiansiswa()
    {
        return $this->hasOne('App\Models\User');
    }

    public function jawabanEssai()
    {
        return $this->belongsToMany('App\Models\JawabanEssai', 'koreksi')->withTimestamps();
    }

    public function pelajaran()
    {
        return $this->belongsTo('App\Models\Pelajaran');
    }

    public function korektorSoal()
    {
        return $this->hasOne('App\Models\KorektorSoal');
    }
}
