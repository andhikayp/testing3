<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sekolah;
use App\Models\UjianSiswa;
use Debugbar;

class NilaiController extends Controller
{
    public function index()
    {
        return view('nilai.index');
    }

    public function nilai($id)
    {
    	$sekolah = Sekolah::where('id',$id)->first();
        return view('nilai.view', compact('sekolah'));
    }

    public function nilai_individu($sekolah, $id)
    {
    	$nilai = UjianSiswa::where('user_id', $id)->get();
    	// dd($nilai[0]->user->nama);
    	// Debugbar::error($nilai);
        return view('nilai.nilai_individu', compact('nilai','sekolah'));
    }
}
