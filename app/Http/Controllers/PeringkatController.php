<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KabKota;
use DB;
use DataTables;
use Carbon\Carbon;
use App\Models\Sekolah;
use App\Models\JadwalUjian;


class PeringkatController extends Controller
{
	public function index() {
		$ranking = $this->peringkat_kota('all');
		$ranking_2013 = $this->peringkat_kota('2013');
		$ranking_2006 = $this->peringkat_kota('2006');
        return view('peringkat.index', compact('ranking', 'ranking_2013', 'ranking_2006'));
	}

	public function peringkat_kota($id){
		$kotas = KabKota::select('*')->get();
		foreach($kotas as $kota) {
			$kode_kota = '__'.$kota->kd_rayon.'%';
			if($id == 'all') $kota->sekolah = Sekolah::where('kode','LIKE',$kode_kota)->get();
			else $kota->sekolah = Sekolah::where('kode','LIKE',$kode_kota)->where('kurikulum', $id)->get();

			if(count($kota->sekolah) > 0) {
				$jumlah_rata_rata = 0;
	        	foreach($kota->sekolah as $sekolah) {
	        		$jumlah_rata_rata += $sekolah->nilai_rata_rata;  
	        	}
	        	$kota->rata_rata = round($jumlah_rata_rata/$kota->sekolah->count()*100, 2);
			} else {
				$kota->rata_rata = 0;
			}
		}
		return $kotas->sortByDesc('rata_rata');
	}

	public function ajax_peringkat_kota($id){
		$ranking = $this->peringkat_kota($id);
        return Datatables::of($ranking)->make(true);
	}
}
