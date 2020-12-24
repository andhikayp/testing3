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
    public function index()
    {
        return view('soal.index');
    }

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
    	$all_soal = Soal::where('paket_id', $id)->where('tipe_soal','pilihan_ganda')->orderBy('tipe_soal','desc')->get();
        return view('ujian.soal', compact('all_soal', 'paket'));
    }

    public function ajaxSoal($id)
    {
    	$soal = Soal::select('deskripsi', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'pilihan_e', 'kunci_jawaban', 'tipe_soal')->where('paket_id', $id)->orderBy('tipe_soal','desc')->get();
        return Datatables::of($soal)
        	->rawColumns(['deskripsi', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'pilihan_e', 'kunci_jawaban', 'tipe_soal'])
        	->make(true);
    }
}
