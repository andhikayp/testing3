<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Soal;
use App\Models\Pelajaran;
use App\Models\UjianSiswa;
use DataTables;

class BankSoalController extends Controller
{
    public function index() {
        return view('bank_soal.index');
    }

    public function kriteria($pelajaran_id, $ket){
        $paket = Paket::where('pelajaran_id', $pelajaran_id)->get();
        $paket_id = [];
        $paket_id_tidak_diuji = [];
        foreach($paket as $p){
            if (!UjianSiswa::where('paket_id', $p->id)->exists()) {
                array_push($paket_id_tidak_diuji, $p->id);
            } else {
                array_push($paket_id, $p->id);
            }
        }
        if($ket != "tidak_diuji"){
            $soals = Soal::whereIn('paket_id', function($query) use ($paket_id){
                $query->select('id')->from(with(new Paket)->getTable())->whereIn('id', $paket_id);
            })->where('tipe_soal', 'pilihan_ganda')->get();

            foreach($soals as $k => $val){
                if($val->analisis->tingkat_kesulitan > 0.7){
                    $val->tingkat_kesulitan = "Sukar";
                } elseif($val->analisis->tingkat_kesulitan > 0.3){
                    $val->tingkat_kesulitan = "Sedang";
                } else{
                    $val->tingkat_kesulitan = "Mudah";
                }
                if($ket == "terima"){
                    if($val->analisis->daya_pembeda <= 0.3) { 
                        unset($soals[$k]);
                    }
                } else if($ket == "revisi"){
                    if($val->analisis->daya_pembeda > 0.3 or $val->analisis->daya_pembeda < 0.2) { 
                        unset($soals[$k]); 
                    } 
                } else if($ket == "tolak"){
                    if($val->analisis->daya_pembeda > 0.2) { 
                        unset($soals[$k]); 
                    } 
                }
            }
        } elseif($ket == "tidak_diuji"){
            $soals = Soal::whereIn('paket_id', function($query) use ($paket_id_tidak_diuji){
                $query->select('id')->from(with(new Paket)->getTable())->whereIn('id', $paket_id_tidak_diuji);
            })->where('tipe_soal', 'pilihan_ganda')->get();
            foreach($soals as $val){
                $val->tingkat_kesulitan = "-";
            }
        }
    	return $soals;
    }

    public function ajax_bank_soal($ket, $pelajaran_id){
    	if($ket == "terima") {
    		$soals = $this->kriteria($pelajaran_id, "terima");
    	} else if($ket == "revisi") {
    		$soals = $this->kriteria($pelajaran_id, "revisi");
    	} else if($ket == "tolak") {
    		$soals = $this->kriteria($pelajaran_id, "tolak");
    	} else if($ket == "tidak_diuji") {
            $soals = $this->kriteria($pelajaran_id, "tidak_diuji");
        }
    	return Datatables::of($soals)
            ->rawColumns(['deskripsi', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'pilihan_e'])
            ->make(true);
    }

    public function terima($pelajaran_id){
    	$soals = $this->kriteria($pelajaran_id, "terima");
    	return Datatables::of($soals)->make(true);
    }

    public function revisi($pelajaran_id){
        $soals = $this->kriteria($pelajaran_id, "revisi");
        return Datatables::of($soals)->make(true);
    }


    public function tolak($pelajaran_id){
    	$soals = $this->kriteria($pelajaran_id, "tolak");	
    	return Datatables::of($soals)->make(true);
    }

    public function view_bank_soal($pelajaran_id) {
        $count['terima'] = 0;
        $count['revisi'] = 0;
        $count['tolak'] = 0;
        $count['tidak_diuji'] = 0;
        $pelajaran = Pelajaran::where('id', $pelajaran_id)->first();
        $paket = Paket::where('pelajaran_id', $pelajaran_id)->get();
        foreach($paket as $p){
            $soals = Soal::where('paket_id', $p->id)->where('tipe_soal', 'pilihan_ganda')->get();
            if (!UjianSiswa::where('paket_id', $p->id)->exists()) {
                $count['tidak_diuji'] += count($soals);
            } else {
                foreach($soals as $val){
                    if($val->analisis->daya_pembeda >= 0.3) { 
                        $count['terima'] += 1;
                    } else if($val->analisis->daya_pembeda < 0.3 and $val->analisis->daya_pembeda >= 0.2) { 
                        $count['revisi'] += 1;
                    } else if($val->analisis->daya_pembeda < 0.2) { 
                        $count['tolak'] += 1;
                    } 
                }
            }
        }
        return view('bank_soal.view', compact('pelajaran_id', 'pelajaran', 'count'));
    }
}
