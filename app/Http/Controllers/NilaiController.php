<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sekolah;
use App\Models\UjianSiswa;
use App\Models\Soal;
use App\Models\Pelajaran;
use App\Models\Paket;
use App\Models\User;
use Debugbar;
use DataTables;
use DB;

class NilaiController extends Controller
{
    public function index() {
        return view('nilai.index');
    }

    public function nilai($id) {
    	$sekolah = Sekolah::where('id',$id)->first();
        return view('nilai.view', compact('sekolah'));
    }

    public function nilai_individu($sekolah, $id) {
    	$nilai = UjianSiswa::where('user_id', $id)->get();
        $all_nilai = []; 
        foreach ($nilai as $n) {
            $n->skor = $n->jumlah_benar/($n->jumlah_benar+$n->jumlah_salah+$n->jumlah_kosong-5)*100;
            array_push($all_nilai, $n->skor);
        }
        $urutan_nilai = UjianSiswa::select(DB::raw('(jumlah_benar/(jumlah_benar+jumlah_salah+jumlah_kosong-5))*100 AS nilai'), 'paket_id')->where('user_id', $id)->orderBy('nilai', 'DESC')->get();
        $nilai_tertinggi = $urutan_nilai->take(3); 
        $nilai_terendah = $urutan_nilai->reverse()->take(3);

        $statistik = $this->get_statistik($all_nilai);
        // dd($statistik);

        return view('nilai.nilai_individu', compact('nilai','sekolah', 'nilai_tertinggi', 'nilai_terendah', 'statistik'));
    }

    public function get_statistik($all_nilai) {
        $statistik['mean'] = $this->mean($all_nilai);
        // $statistik['modus'] = $this->modus($all_nilai);
        $statistik['min'] = $this->min($all_nilai);
        $statistik['max'] = $this->max($all_nilai);
        $statistik['range'] = $statistik['max'] - $statistik['min'];
        $statistik['standar_deviasi'] = $this->standar_deviasi($all_nilai);
        $statistik['varian'] = pow($statistik['standar_deviasi'], 2);
        $statistik['q1'] = $this->Quartile($all_nilai, 0.25);
        $statistik['q2'] = $this->Quartile($all_nilai, 0.50);
        $statistik['q3'] = $this->Quartile($all_nilai, 0.75);
        return $statistik;
    }

    public function mean($array){
        $count = count($array); 
        $sum = array_sum($array); 
        return $sum / $count;
    }

    public function modus($array){
    
    }

    public function min($array){
        sort($array);                 
        return $array[0];                
    }

    public function max($array){                
        rsort($array);                 
        return $array[0]; 
    }

    public function Quartile($Array, $Quartile) {
        sort($Array);
        $pos = (count($Array) - 1) * $Quartile;

        $base = floor($pos);
        $rest = $pos - $base;

        if( isset($Array[$base+1]) ) {
            return $Array[$base] + $rest * ($Array[$base+1] - $Array[$base]);
        } else {
            return $Array[$base];
        }
    }

    public function standar_deviasi($array) { 
        $num_of_elements = count($array);   
        $variance = 0.0;    
        // calculating mean using array_sum() method 
        $average = array_sum($array)/$num_of_elements; 
        foreach($array as $i) { 
            // sum of squares of differences between all numbers and means. 
            $variance += pow(($i - $average), 2); 
        } 
        return (float)sqrt($variance/$num_of_elements); 
    } 


    public function ajaxNilaiSiswa($id)
    {
        $nilai = UjianSiswa::select('id','jumlah_benar', 'jumlah_salah', 'jumlah_kosong', 'paket_id', 'user_id')->where('user_id', $id)->get();
        foreach ($nilai as $nilais) {
            $nilais->mata_pelajaran = $nilais->paket->pelajaran->nama;
            $nilais->nilai_tanpa_koreksi = round($nilais->jumlah_benar/($nilais->jumlah_benar+$nilais->jumlah_salah+$nilais->jumlah_kosong-5)*100, 2);
            $nilais->nilai_dengan_koreksi = round(($nilais->jumlah_benar-($nilais->jumlah_salah/(5-1)))/($nilais->jumlah_benar+$nilais->jumlah_salah+$nilais->jumlah_kosong-5)*100 ,2);
            $nilais->rata_rata_jatim = $nilais->paket->nilai_rata_rata;
            $nilais->count = UjianSiswa::where('paket_id', $nilais->paket_id)->count();
        }
        return Datatables::of($nilai)->make(true);
    }

    public function soal_individu($mapel_id, $id)
    {
        ini_set('memory_limit', '-1');
        $ujian_siswa = UjianSiswa::where('id', $mapel_id)->first();
        $random_soal = json_decode($ujian_siswa->random_soal);
        $jawaban_posisi = json_decode($ujian_siswa->random_jawaban);
        $jawabans = json_decode($ujian_siswa->jawaban_siswa);
        $all_soal = array();
        foreach ($random_soal as $key => $soal_id) {
            $soal = Soal::find($soal_id);
            $soal->benar = 0;                        
            $soal->kosong = 0;                        
            if($soal->tipe_soal == "pilihan_ganda"){
                if($jawabans[$key] == " "){
                    $soal->kosong = 1;                        
                } else{
                    $inttochar = array("1" => "a","2"=>"b","3"=>"c","4"=>"d","5"=>"e");
                    $arr_random = array("a" => $inttochar[$jawaban_posisi[$key][0]],
                                        "b" => $inttochar[$jawaban_posisi[$key][1]],
                                        "c" => $inttochar[$jawaban_posisi[$key][2]],
                                        "d" => $inttochar[$jawaban_posisi[$key][3]],
                                        "e" => $inttochar[$jawaban_posisi[$key][4]]);
                    $soal->kunci_jawaban = strtoupper($soal->kunci_jawaban);
                    $soal->jawaban_siswa = strtoupper($arr_random[strtolower($jawabans[$key])]);
                    if($arr_random[strtolower($jawabans[$key])] == strtolower($soal->kunci_jawaban)){
                        $soal->benar = 1;
                    }
                }
                array_push($all_soal, $soal);
            }
        }
        Debugbar::error($all_soal);
        return view('nilai.soal_individu', compact('ujian_siswa','all_soal'));
    }

    public function capaian_nasional(){
        if(Auth()->user()->level == 'admin') {
            $mapel = Pelajaran::all()->sortBy('kurikulum');
        } else {
            $sekolah_id = Auth()->user()->sekolah_id;
            $pelajaran_id = Paket::select('pelajaran_id')->whereIn('id', function($query) use ($sekolah_id){
                $query->select('paket_id')->from(with(new UjianSiswa)->getTable())->whereIn('user_id', function($query2) use ($sekolah_id){
                    $query2->select('id')->from(with(new User)->getTable())->where('sekolah_id', $sekolah_id);
                })->distinct('paket_id')->get();
            })->distinct('pelajaran_id')->get();
            $mapel = Pelajaran::whereIn('id', $pelajaran_id)->get();
        }
        return view('nilai.capaian_nasional', compact('mapel'));
    }

    public function ajax_get_pelajaran($kurikulum){
        if(Auth()->user()->level == 'admin'){
            if($kurikulum == 'all'){
                $pelajaran = Pelajaran::all()->get();
            } else{
                $pelajaran = Pelajaran::where('kurikulum', $kurikulum)->get();
            }
        } else{
            $sekolah_id = Auth()->user()->sekolah_id;
            $pelajaran_id = Paket::select('pelajaran_id')->whereIn('id', function($query) use ($sekolah_id){
                $query->select('paket_id')->from(with(new UjianSiswa)->getTable())->whereIn('user_id', function($query2) use ($sekolah_id){
                    $query2->select('id')->from(with(new User)->getTable())->where('sekolah_id', $sekolah_id);
                })->distinct('paket_id')->get();
            })->distinct('pelajaran_id')->get();
            $pelajaran = Pelajaran::whereIn('id', $pelajaran_id)->get();
        }
        return response()->json($pelajaran);
    }

    public function ajax_rata2_paket($pelajaran_id){
        $paket = Paket::where('pelajaran_id', $pelajaran_id)->get();
        $sum = 0;
        foreach($paket as $k => $p){
            if($p->nilai_rata_rata) {
                $p->keterangan = "Diujikan";
            } else{
                if(Auth()->user()->level != 'admin'){
                    unset($paket[$k]);
                } else {
                    $p->keterangan = "Tidak Diujikan";
                }
            }
            $p->nilai_rata_rata = round($p->nilai_rata_rata*100, 2);
            $p->nama = str_replace('_', ' ', $p->nama);
            $p->nama_baru = substr(strstr($p->nama," "), 1);
            $count_siswa =  UjianSiswa::where('paket_id', $p->id)->count();
            if($count_siswa > 0){
                $p->count_siswa = number_format($count_siswa , 0, ',', '.')." siswa";
            } else{
                $p->count_siswa = "-";
            }
            if(Auth()->user()->level != 'admin'){
                $user_id = User::select('id')->where('sekolah_id', Auth()->user()->sekolah->id)->get();
                $p->count_siswa_sekolah = UjianSiswa::where('paket_id', $p->id)->whereIn('user_id', $user_id)->count();
                $p->jumlah_benar = UjianSiswa::where('paket_id', $p->id)->whereIn('user_id', $user_id)->sum('jumlah_benar');
                $p->jumlah_salah = UjianSiswa::where('paket_id', $p->id)->whereIn('user_id', $user_id)->sum('jumlah_salah');
                $p->jumlah_kosong = UjianSiswa::where('paket_id', $p->id)->whereIn('user_id', $user_id)->sum('jumlah_kosong');
                $penyebut =  $p->jumlah_benar+$p->jumlah_salah+$p->jumlah_kosong-(5*$p->count_siswa_sekolah);
                if($penyebut == 0) $p->rata2_sekolah = 0;
                else $p->rata2_sekolah = round(($p->jumlah_benar / $penyebut)*100, 2);       
            }
            $sum += $p->nilai_rata_rata;
        }
        return Datatables::of($paket)->make(true);
    }
}
