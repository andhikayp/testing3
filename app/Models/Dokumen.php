<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'dokumen';

    public function sekolah()
    {
        return $this->belongsTo('App\Models\Sekolah');
    }
    
    public function pelajaran()
    {
        return $this->belongsTo('App\Models\Pelajaran');
    }

    public function getFileFullPath()
    {
        return storage_path("app/dokumen/{$this->sekolah->namaSekolahCleaned()}/{$this->file}");
    }
}
