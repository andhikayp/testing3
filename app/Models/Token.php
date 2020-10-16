<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
    'id', 'token', 'sekolah_id',
    'server_id', 'status'
    ];
}
