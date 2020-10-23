<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'server';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
    'id',
    'nama'
    ];

}