<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KabKota;
use DataTables;
use App\Models\Sekolah;
use App\Models\User;


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

    public function ajaxSekolah($id)
    {
        $kode_kota = '__'.$id.'%'; 
        $sekolah = Sekolah::where('kode','LIKE',$kode_kota)->orderBy('created_at', 'asc')->get();
        return Datatables::of($sekolah)
        	->addColumn('action', function ($user) {
                return '<a href="'.url('siswa', $user->id).'"><button type="button" class="btn btn-primary bg-gd-primary min-width-75">Lihat Detail</button></a>';
            })
            ->rawColumns(['action'])
        	->make(true);
    }

    public function siswa($id)
    {
        $sekolah = Sekolah::where('id',$id)->first();
        return view('siswa.view', compact('sekolah'));
    }

    public function ajaxSiswa($id)
    {
    	$siswa = User::where('sekolah_id', $id)->where('level','siswa')->get();
        return Datatables::of($siswa)->make(true);
    }
}