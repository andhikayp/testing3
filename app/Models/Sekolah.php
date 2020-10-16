<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    /**
     * Config this model
     */
    protected $primaryKey = 'id';
    public $incrementing = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sekolah';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'nama',
        'alamat',
        'npsn',
        'kurikulum',
        'kode'
    ];

    /**
     * One to Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function server()
    {
        return $this->hasMany('App\Models\Server');
    }

    public function ujians()
    {
        return $this->hasManyThrough('App\Models\UjianSiswa', 'App\Models\User');
    }

    public function namaSekolahCleaned()
    {
        return preg_replace('/[^\da-z]/i', '', $this->nama);
    }

    public function serial_numbers(){
        return $this->hasMany('App\Models\SerialNumber');
    }
}
