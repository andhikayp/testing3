<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KabKota;
use DataTables;


class SiswaController extends Controller
{
    public function index()
    {
        return view('siswa.index');
    }

    public function ajaxIndex()
    {
    	$kota = KabKota::select('kd_rayon','nama')->orderBy('kd_rayon')->get();
        return Datatables::of($kota)->make(true);
    }
}