<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
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
    protected $table = 'downloads';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
    'id',
    'sekolah_id',
    'user_id',
    'tipe',
    'file_name'
    ];

    public function sekolah()
    {
        return $this->belongsTo('App\Models\Sekolah');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function findJadwal($id)
    {
        $obj = JadwalUjian::find($id);
        if($obj)
        {
            return $obj->deskripsi;
        }
        else
            return '';
    }
}
