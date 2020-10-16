<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogServer extends Model
{
    /**
     * Config this model
     */
    protected $primaryKey='id';
    public $incrementing = true;

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'log_server';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
    'id',
    'sekolah_id',
    'sekolah_nama',
    'server_id',
    'jadwal_ujian_id',
    'deskripsi_jadwal',
    'state'
    ];
}
