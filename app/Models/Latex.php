<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Latex extends Model
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'latex';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
    'latex_codecogs',
    'latex_mathjax',
    'soal_id'
    ];

    /**
	 * One to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function soal(){
        return $this->belongsTo('App\Models\Soal');
    }
}
