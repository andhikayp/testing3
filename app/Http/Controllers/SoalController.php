<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelajaran;
use App\Models\Paket;
use App\Models\Soal;
use DB;
use DataTables;

class SoalController extends Controller
{
    public function ajaxPelajaran()
    {
    	$pelajaran = Pelajaran::all();
        return Datatables::of($pelajaran)->make(true);
    }  

    public function ajaxPaket($pelajaran)
    {
        $paket = Paket::where('pelajaran_id', $pelajaran)->get();
        return Datatables::of($paket)
        	->addColumn('action', function ($user) {
                return '<a href="'.url('paket', $user->id).'"><button type="button" class="btn btn-primary bg-gd-primary min-width-75 float-right">Lihat Detail</button></a>';
            })
            ->rawColumns(['action'])
        	->make(true);
    }

    public function paket($id)
    {
        $paket = Paket::find($id);
    	$soal = Soal::where('paket_id', $id)->orderBy('tipe_soal','desc')->get();
        return view('ujian.soal', compact('soal','paket'));
    }
}
