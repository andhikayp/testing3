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
                return '<a href="'.url('paket', $user->id).'"><button type="button" class="btn btn-primary bg-gd-primary min-width-75">Lihat Detail</button></a>';
            })
            ->rawColumns(['action'])
        	->make(true);
    }

    public function paket($id)
    {
    	$soal = Soal::where('paket_id', $id)->get();
        return Datatables::of($soal)->make(true);
    }
}
