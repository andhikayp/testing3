<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SerialNumber extends Model
{
    //
    public function sekolah()
    {
        return $this->belongsTo('App\Models\Sekolah');
    }
}
