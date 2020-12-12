<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KabKota;
use DB;
use DataTables;
use Carbon\Carbon;
use App\Models\Sekolah;
use App\Models\User;
use App\Models\JadwalUjian;


class PeringkatController extends Controller
{
	public function index() {
		$ranking = $this->peringkat_kota('all');
		$ranking_2013 = $this->peringkat_kota('2013');
		$ranking_2006 = $this->peringkat_kota('2006');
		$ranking_sekolah = $this->peringkat_sekolah('all');
		$ranking_sekolah_2013 = $this->peringkat_sekolah('2013');
		$ranking_sekolah_2006 = $this->peringkat_sekolah('2006');
        return view('peringkat.index', compact('ranking', 'ranking_2013', 'ranking_2006', 'ranking_sekolah', 'ranking_sekolah_2013', 'ranking_sekolah_2006'));
	}

	public function peringkat_kota($id){
		$kotas = KabKota::select('*')->get();
		foreach($kotas as $kota) {
			$kode_kota = '__'.$kota->kd_rayon.'%';
			if($id == 'all') $kota->sekolah = Sekolah::where('kode','LIKE',$kode_kota)->get();
			else $kota->sekolah = Sekolah::where('kode','LIKE',$kode_kota)->where('kurikulum', $id)->get();
			$kota->jumlah_sekolah = count($kota->sekolah);
			
			if(count($kota->sekolah) > 0) {
				$jumlah_rata_rata = 0;
	        	foreach($kota->sekolah as $sekolah) {
	        		$jumlah_rata_rata += $sekolah->nilai_rata_rata;
	        	}
	        	$kota->nilai_rata_rata = round($jumlah_rata_rata/$kota->sekolah->count()*100, 2);
			} else {
				$kota->nilai_rata_rata = 0;
			}
		}
		$no = 1;
		$kotas =  $kotas->sortByDesc('nilai_rata_rata');
		foreach ($kotas as $kota) {
			$kota->no = $no++;
		}
		return $kotas;
	}

	public function peringkat_sekolah($id){
		if($id == 'all') {
			$sekolah = Sekolah::all();
		} else {
			$sekolah = Sekolah::where('kurikulum', $id)->get();
		}
		$no = 1;
		$sekolah = $sekolah->sortByDesc('nilai_rata_rata');
		foreach($sekolah as $s) {
			$s->no = $no++;
			$s->nilai_rata_rata = round($s->nilai_rata_rata*100, 2);
		}
		return $sekolah;
	}

	public function ajax_peringkat_kota($id){
		$ranking = $this->peringkat_kota($id);
        return Datatables::of($ranking)->make(true);
	}

	public function ajax_peringkat_sekolah($id){
		$ranking = $this->peringkat_sekolah($id);
        return Datatables::of($ranking)->make(true);

	}
}
