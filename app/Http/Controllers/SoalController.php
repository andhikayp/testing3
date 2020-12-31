<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelajaran;
use App\Models\Paket;
use App\Models\Soal;
use App\Models\User;
use App\Models\UjianSiswa;
use DB;
use DataTables;

class SoalController extends Controller
{
    public function index()
    {
        if(Auth()->user()->level == 'admin'){
            $count_pelajaran = $this->getCountPelajaran();
            foreach($count_pelajaran as $c) {
                $paket =  $this->getKurikulumPaket($c->kurikulum);
                $c->paket_count = count($paket);
                $c->paket_digunakan = 0;
                $c->paket_tidak_digunakan = 0;
                foreach($paket as $p){
                    if (UjianSiswa::where('paket_id', $p->id)->exists()) {
                       $c->paket_digunakan +=1;
                    } else {
                       $c->paket_tidak_digunakan +=1;
                    }
                }
            }
            return view('soal.index', compact('count_pelajaran'));
        } else{
            $paket =  $this->getPaketSekolahId(Auth()->user()->sekolah->id);
            $pelajaran = $this->getPelajaranId();
            return view('soal.index', compact('paket', 'pelajaran'));
        }
    }

    public function getPaketSekolahId($sekolah_id){
        $pelajaran = Paket::select('*')->whereIn('id', function($query) use ($sekolah_id){
            $query->select('paket_id')->from(with(new UjianSiswa)->getTable())->whereIn('user_id', function($query2) use ($sekolah_id){
                $query2->select('id')->from(with(new User)->getTable())->where('sekolah_id', $sekolah_id);
            })->distinct('paket_id')->get();
        })->get();
        return $pelajaran;
    }

    public function getKurikulumPaket($kurikulum){
        $count_paket = Paket::whereIn('pelajaran_id', function($query) use ($kurikulum){
            $query->select('id')->from(with(new Pelajaran)->getTable())->where('kurikulum', $kurikulum);
        })->get();
        return $count_paket;
    }

    public function ajaxPelajaran() {
        if(Auth()->user()->level == 'admin') {
            $pelajaran = Pelajaran::all();
        } else {
            $pelajaran_id = $this->getPelajaranId();
            $pelajaran = Pelajaran::whereIn('id', $pelajaran_id)->get();
        }
        return Datatables::of($pelajaran)->make(true);
    } 

    public function ajaxPelajaranWithAction()
    {
        $pelajaran = Pelajaran::all();
        return Datatables::of($pelajaran)
            ->addColumn('action', function ($pelajaran) {
                return '<a href="'.url('bank_soal', $pelajaran->id).'"><button type="button text-center" class="btn btn-primary bg-gd-primary min-width-75">Lihat Detail</button></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    } 


    public function ajaxPaket($pelajaran)
    {
        $paket = Paket::where('pelajaran_id', $pelajaran)->get();
        foreach($paket as $k => $p){
            if (UjianSiswa::where('paket_id', $p->id)->exists()) {
                $p->keterangan = "Diujikan";
            } else {
                if(Auth()->user()->level != 'admin') {
                    unset($paket[$k]);
                } else {
                    $p->keterangan = "Tidak Diujikan";
                }
            }
        }
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
    	$soal_pilgan = Soal::where('paket_id', $id)->where('tipe_soal','pilihan_ganda')->orderBy('created_at', 'asc')->get();
        $soal_essai = Soal::where('paket_id', $id)->where('tipe_soal','essai')->orderBy('created_at', 'asc')->get();
        return view('ujian.soal', compact('soal_pilgan', 'soal_essai', 'paket'));
    }

    public function ajaxSoal($id)
    {
    	$soal = Soal::select('deskripsi', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'pilihan_e', 'kunci_jawaban', 'tipe_soal')->where('paket_id', $id)->orderBy('tipe_soal','desc')->orderBy('created_at', 'asc')->get();
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
        $soals = Soal::where('paket_id', $paket_id)->where('tipe_soal', 'pilihan_ganda')->orderBy('created_at', 'asc')->get();
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
        $soals = Soal::where('paket_id', $paket_id)->where('tipe_soal', 'pilihan_ganda')->orderBy('created_at', 'asc')->get();
        $distribusi_daya_pembeda = $this->initDistribusiDayaPembeda();
        foreach($soals as $soal) {
            if($soal->analisis->daya_pembeda > 0.4) $distribusi_daya_pembeda[0]['jumlah'] += 1;
            elseif($soal->analisis->daya_pembeda > 0.3) $distribusi_daya_pembeda[1]['jumlah'] += 1;
            elseif($soal->analisis->daya_pembeda > 0.2) $distribusi_daya_pembeda[2]['jumlah'] += 1;
            else $distribusi_daya_pembeda[3]['jumlah'] += 1;
        }
        return $distribusi_daya_pembeda;
    }

    public function getPengecohJawaban($jumlah, $jawaban, $jumlah_siswa){
        $fungsi_pengecoh = $jawaban / $jumlah_siswa;
        if($fungsi_pengecoh > 0.05) $jumlah+=1;
        return $jumlah;
    }

    public function getCountPengecoh($soal){
        $jumlah = 0;
        $jumlah = $this->getPengecohJawaban($jumlah, $soal->jawaban_a, $soal->jumlah_siswa);
        $jumlah = $this->getPengecohJawaban($jumlah, $soal->jawaban_b, $soal->jumlah_siswa);
        $jumlah = $this->getPengecohJawaban($jumlah, $soal->jawaban_c, $soal->jumlah_siswa);
        $jumlah = $this->getPengecohJawaban($jumlah, $soal->jawaban_d, $soal->jumlah_siswa);
        $jumlah = $this->getPengecohJawaban($jumlah, $soal->jawaban_e, $soal->jumlah_siswa);
        return $jumlah;
    }

    public function getFungsiPengecoh($paket_id){
        $soals = Soal::where('paket_id', $paket_id)->where('tipe_soal', 'pilihan_ganda')->orderBy('created_at', 'asc')->get();
        $no = 1;
        foreach ($soals as $soal) {
            $soal->no_soal = "Soal ".$no++;
            $soal->jumlah_pengecoh = $this->getCountPengecoh($soal);
        }
        return $soals;
    }

    public function getAnalisisButirSoal($paket_id){
        $hasil['fungsi_pengecoh_all'] = $this->getCountFungsiPengecohAll($paket_id);
        $hasil['tingkat_kesukaran'] = $this->getTingkatKesukaran($paket_id);
        $hasil['daya_pembeda'] = $this->getDayaPembeda($paket_id);
        $hasil['fungsi_pengecoh'] = $this->getFungsiPengecoh($paket_id);
        return response()->json($hasil);
    }

    public function initDistribusiFungsiPengecoh(){
        $distribusi = array();
        for($i=1; $i <= 5; $i++){
            $distribusi[$i]['nama'] = $i.' pilihan jawaban';
            $distribusi[$i]['jumlah'] = 0;
        }
        return $distribusi;
    }

    public function getCountFungsiPengecohAll($paket_id) {
        $soals = $this->getFungsiPengecoh($paket_id);
        $distribusi = $this->initDistribusiFungsiPengecoh();
        foreach ($soals as $soal) {
            if($soal->jumlah_pengecoh == 1) $distribusi[1]['jumlah']++;
            elseif($soal->jumlah_pengecoh == 2) $distribusi[2]['jumlah']++;
            elseif($soal->jumlah_pengecoh == 3) $distribusi[3]['jumlah']++;
            elseif($soal->jumlah_pengecoh == 4) $distribusi[4]['jumlah']++;
            elseif($soal->jumlah_pengecoh == 5) $distribusi[5]['jumlah']++;        
        }
        return Datatables::of($distribusi)->make(true);
    }

    public function cetak($paket_id){
        $packet = Paket::find($paket_id);
        try {
            $soals_pilgan = Soal::where('paket_id',$paket_id)->where('tipe_soal', 'pilihan_ganda')->orderBy('created_at', 'asc')->get()
            ->toArray();
            $soals_essay = Soal::where('paket_id',$paket_id)->where('tipe_soal', 'essai')->orderBy('created_at', 'asc')->get()
                    ->toArray();
        } catch (Exception $e) {
            Log::info('Error message: ' . $e->getMessage());
            return;
        }
        
        $arr_soals = array_merge($soals_pilgan, $soals_essay);
    
        return view('soal.cetak', ['soals' => $arr_soals, 'packet' => $packet]);        
    }

    public function getAllAnalisis($paket_id){
        $soals = Soal::where('paket_id', $paket_id)->where('tipe_soal', 'pilihan_ganda')->orderBy('created_at', 'asc')->get();
        $no = 1;
        foreach ($soals as $soal) {
            $soal->no_soal = "Soal ".$no++;
            $soal->tingkat_kesukaran = $soal->analisis->tingkat_kesukaran;
            $soal->daya_pembeda = $soal->analisis->daya_pembeda;
            $soal->jumlah_pengecoh = $this->getCountPengecoh($soal)/5;
        }
        return response()->json($soals);
    }

    public function getCountPelajaran(){
        $pelajaran = Pelajaran::select('kurikulum', DB::raw('count(*) as total'))->groupBy('kurikulum')->get();
        return $pelajaran;
    }

    public function getPelajaranId(){
        $sekolah_id = Auth()->user()->sekolah_id;
        $pelajaran = Paket::select('pelajaran_id')->whereIn('id', function($query) use ($sekolah_id){
            $query->select('paket_id')->from(with(new UjianSiswa)->getTable())->whereIn('user_id', function($query2) use ($sekolah_id){
                $query2->select('id')->from(with(new User)->getTable())->where('sekolah_id', $sekolah_id);
            })->distinct('paket_id')->get();
        })->distinct('pelajaran_id')->get();
        return $pelajaran;
    }

}
