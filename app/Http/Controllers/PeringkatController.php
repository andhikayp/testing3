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
use App\Models\UjianSiswa;
use App\Models\Paket;
use App\Models\Pelajaran;

class PeringkatController extends Controller
{
	public function index() {
		$ranking = $this->peringkat_kota('all');
		$ranking_2013 = $this->peringkat_kota('2013');
		$ranking_2006 = $this->peringkat_kota('2006');
		$ranking_sekolah = $this->peringkat_sekolah('all');
		$ranking_sekolah_2013 = $this->peringkat_sekolah('2013');
		$ranking_sekolah_2006 = $this->peringkat_sekolah('2006');
		$mapel = Pelajaran::all()->sortBy('kurikulum');
        return view('peringkat.index', compact('ranking', 'ranking_2013', 'ranking_2006', 'ranking_sekolah', 'ranking_sekolah_2013', 'ranking_sekolah_2006', 'mapel'));
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

	public function ajax_sebaran_peringkat_sekolah($kurikulum) {
		$ranking = $this->peringkat_sekolah($kurikulum);
		$distribusi = array();

		for($i=10; $i > 0; $i--){
			$distribusi[$i]['nama'] = 'Nilai ' . strval(($i*10)-10) . ' - ' . strval($i*10);
			$distribusi[$i]['jumlah'] = 0;
		}

		foreach($ranking as $r) {
			if($r->nilai_rata_rata < 10) $distribusi[1]['jumlah']++;
			elseif($r->nilai_rata_rata < 20) $distribusi[2]['jumlah']++;
			elseif($r->nilai_rata_rata < 30) $distribusi[3]['jumlah']++;
			elseif($r->nilai_rata_rata < 40) $distribusi[4]['jumlah']++;
			elseif($r->nilai_rata_rata < 50) $distribusi[5]['jumlah']++;
			elseif($r->nilai_rata_rata < 60) $distribusi[6]['jumlah']++;
			elseif($r->nilai_rata_rata < 70) $distribusi[7]['jumlah']++;
			elseif($r->nilai_rata_rata < 80) $distribusi[8]['jumlah']++;
			elseif($r->nilai_rata_rata < 90) $distribusi[9]['jumlah']++;
			elseif($r->nilai_rata_rata < 100) $distribusi[10]['jumlah']++;
		}
        return Datatables::of($distribusi)->make(true);
	}

	public function get_rank_siswa($limit, $kurikulum)
	{
		if($kurikulum == 'all') {
			$ranking = User::orderByDesc('nilai_rata_rata')->limit($limit)->get();
		} else {
			$ranking = User::whereIn('sekolah_id', function($query) use ($kurikulum) {
				$query->select('id')->from(with(new Sekolah)->getTable())->where('kurikulum', $kurikulum);
			})->orderByDesc('nilai_rata_rata')->limit($limit)->get();
		}
		$no = 1;
		foreach ($ranking as $r) {
			$r->no = $no++;
			$r->nama_sekolah = $r->sekolah->nama;
			$r->nilai_rata_rata = round($r->nilai_rata_rata * 100, 2);
		}
        return Datatables::of($ranking)->make(true);
	}

	public function get_rank_pelajaran($pelajaran_id){
		$ranking = UjianSiswa::select('id', 'user_id', 'jumlah_benar', 'jumlah_salah', 'jumlah_kosong', 'paket_id')->whereIn('paket_id', function($query) use ($pelajaran_id) {
			$query->select('id')->from(with(new Paket)->getTable())->where('pelajaran_id', $pelajaran_id);    	
		})->orderByDesc('jumlah_benar')->limit(30)->get();
		$no = 1;
		foreach ($ranking as $r) {
			$r->no = $no++;
			$r->nama = $r->user->nama;
			$r->nisn = $r->user->nisn;
			$r->nama_sekolah = $r->user->sekolah->nama;
			$r->nilai_rata_rata = round($r->jumlah_benar / ($r->jumlah_benar + $r->jumlah_kosong + $r->jumlah_salah - 5) * 100, 2);
		}
        return Datatables::of($ranking)->make(true);
	}
}
