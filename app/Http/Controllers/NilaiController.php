<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sekolah;

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
}
