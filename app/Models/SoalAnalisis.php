<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoalAnalisis extends Model
{
    protected $table = 'soal_analisis';
    
    public function soal()
    {
    	 return $this->belongsTo('App\Models\Soal');
    }
}
