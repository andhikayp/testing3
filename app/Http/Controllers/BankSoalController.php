<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Soal;
use App\Models\Pelajaran;
use DataTables;

class BankSoalController extends Controller
{
    public function index() {
        return view('bank_soal.index');
    }

    public function kriteria($pelajaran_id, $ket){
    	$soals = Soal::whereIn('paket_id', function($query) use ($pelajaran_id){
            $query->select('id')->from(with(new Paket)->getTable())->where('pelajaran_id', $pelajaran_id);
    	})->where('tipe_soal', 'pilihan_ganda')->get();
    	foreach($soals as $k => $val){
    		if($ket == "terima"){
    			if($val->analisis->daya_pembeda < 0.3) { 
    			    unset($soals[$k]);
    			} 
    		} else if($ket == "revisi"){
    			if($val->analisis->daya_pembeda > 0.3 and $val->analisis->daya_pembeda < 0.2) { 
    			    unset($soals[$k]); 
    			} 
    		} else if($ket == "tolak"){
    			if($val->analisis->daya_pembeda > 0.2) { 
    			    unset($soals[$k]); 
    			} 
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
    	}
    	return Datatables::of($soals)
    		->rawColumns(['deskripsi', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'pilihan_e'])
    		->make(true);
    }

    public function terima($pelajaran_id){
    	$soals = $this->kriteria($pelajaran_id, "terima");
    	return Datatables::of($soals)->make(true);
    }

    public function tolak($pelajaran_id){
    	$soals = $this->kriteria($pelajaran_id, "tolak");	
    	return Datatables::of($soals)->make(true);
    }

    public function view_bank_soal($pelajaran_id) {
    	$pelajaran = Pelajaran::where('id', $pelajaran_id)->first();
    	$soals = Soal::whereIn('paket_id', function($query) use ($pelajaran_id){
            $query->select('id')->from(with(new Paket)->getTable())->where('pelajaran_id', $pelajaran_id);
    	})->where('tipe_soal', 'pilihan_ganda')->get();
    	$count['terima'] = 0;
    	$count['revisi'] = 0;
    	$count['tolak'] = 0;
    	foreach($soals as $k => $val){
    		if($val->analisis->daya_pembeda > 0.3) { 
    			$count['terima'] += 1;
    		} else if($val->analisis->daya_pembeda < 0.3 and $val->analisis->daya_pembeda > 0.2) { 
    			$count['revisi'] += 1;
    		} else if($val->analisis->daya_pembeda < 0.2) { 
    			$count['tolak'] += 1;
    		} 
    	}
    	return view('bank_soal.view', compact('pelajaran_id', 'pelajaran', 'count'));
    }
}
