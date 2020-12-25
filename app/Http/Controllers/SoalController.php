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
    	$soal_pilgan = Soal::where('paket_id', $id)->where('tipe_soal','pilihan_ganda')->orderBy('tipe_soal','desc')->get();
        $soal_essai = Soal::where('paket_id', $id)->where('tipe_soal','essai')->get();
        return view('ujian.soal', compact('soal_pilgan', 'soal_essai', 'paket'));
    }

    public function ajaxSoal($id)
    {
    	$soal = Soal::select('deskripsi', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'pilihan_e', 'kunci_jawaban', 'tipe_soal')->where('paket_id', $id)->orderBy('tipe_soal','desc')->get();
        return Datatables::of($soal)
        	->rawColumns(['deskripsi', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'pilihan_e', 'kunci_jawaban', 'tipe_soal'])
        	->make(true);
    }

    public function initDistribusiTingkatKesukaran(){
        $distribusi = array();
        $distribusi[0]['tipe'] = "Sulit";
        $distribusi[1]['tipe'] = "Sedang";
        $distribusi[2]['tipe'] = "Mudah";
        $distribusi[0]['jumlah'] = 0;
        $distribusi[1]['jumlah'] = 0;
        $distribusi[2]['jumlah'] = 0;
        return $distribusi;
    }

    public function getTingkatKesukaran($paket_id){
        $soals = Soal::where('paket_id', $paket_id)->where('tipe_soal', 'pilihan_ganda')->get();
        $distribusi_tingkat_kesukaran = $this->initDistribusiTingkatKesukaran();
        foreach($soals as $soal) {
            if($soal->analisis->tingkat_kesukaran > 0.7) $distribusi_tingkat_kesukaran[2]['jumlah'] += 1;
            elseif($soal->analisis->tingkat_kesukaran > 0.3) $distribusi_tingkat_kesukaran[1]['jumlah'] += 1;
            else $distribusi_tingkat_kesukaran[0]['jumlah'] += 1;
        }
        return $distribusi_tingkat_kesukaran;
    }

    public function initDistribusiDayaPembeda(){
        $distribusi = array();
        $distribusi[0]['tipe'] = "Sangat Baik";
        $distribusi[1]['tipe'] = "Cukup Baik";
        $distribusi[2]['tipe'] = "Revisi";
        $distribusi[3]['tipe'] = "Ditolak";
        $distribusi[0]['jumlah'] = 0;
        $distribusi[1]['jumlah'] = 0;
        $distribusi[2]['jumlah'] = 0;
        $distribusi[3]['jumlah'] = 0;
        return $distribusi;
    }

    public function getDayaPembeda($paket_id){
        $soals = Soal::where('paket_id', $paket_id)->where('tipe_soal', 'pilihan_ganda')->get();
        $distribusi_daya_pembeda = $this->initDistribusiDayaPembeda();
        foreach($soals as $soal) {
            if($soal->analisis->daya_pembeda > 0.4) $distribusi_daya_pembeda[0]['jumlah'] += 1;
            elseif($soal->analisis->daya_pembeda > 0.3) $distribusi_daya_pembeda[1]['jumlah'] += 1;
            elseif($soal->analisis->daya_pembeda > 0.2) $distribusi_daya_pembeda[2]['jumlah'] += 1;
            else $distribusi_daya_pembeda[3]['jumlah'] += 1;
        }
        return $distribusi_daya_pembeda;
    }

    public function getFungsiPengecoh(){
        $soals = Soal::where('paket_id', $paket_id)->where('tipe_soal', 'pilihan_ganda')->get();

    }

    public function getAnalisisButirSoal($paket_id){
        $hasil['tingkat_kesukaran'] = $this->getTingkatKesukaran($paket_id);
        $hasil['daya_pembeda'] = $this->getDayaPembeda($paket_id);
        return response()->json($hasil);
    }
}
