<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EncryptionKey extends Model
{
    protected $fillable = ['id', 'key', 'jadwal_ujian_id', 'created_at', 'updated_at'];

    public function jadwal_ujian()
    {
        return $this->belongsTo('App\Models\JadwalUjian');
    }
}
