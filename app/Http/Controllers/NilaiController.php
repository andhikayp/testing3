<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sekolah;
use App\Models\UjianSiswa;
use App\Models\Soal;
use Debugbar;
use DataTables;
use DB;

class NilaiController extends Controller
{
    public function index()
    {
        return view('nilai.index');
    }

    public function nilai($id)
    {
    	$sekolah = Sekolah::where('id',$id)->first();
        return view('nilai.view', compact('sekolah'));
    }

    public function nilai_individu($sekolah, $id)
    {
    	$nilai = UjianSiswa::where('user_id', $id)->get();
        $urutan_nilai = UjianSiswa::select(DB::raw('(jumlah_benar/(jumlah_benar+jumlah_salah+jumlah_kosong-5))*100 AS nilai'), 'paket_id')->where('user_id', $id)->orderBy('nilai', 'DESC')->get();
        $nilai_tertinggi = $urutan_nilai->take(3); 
        $nilai_terendah = $urutan_nilai->reverse()->take(3);
        return view('nilai.nilai_individu', compact('nilai','sekolah', 'nilai_tertinggi', 'nilai_terendah'));
    }

    public function ajaxNilaiSiswa($id)
    {
        $nilai = UjianSiswa::select('id','jumlah_benar', 'jumlah_salah', 'jumlah_kosong', 'paket_id', 'user_id')->where('user_id', $id)->get();
        foreach ($nilai as $nilais) {
            $nilais->mata_pelajaran = $nilais->paket->pelajaran->nama;
            $nilais->nilai_tanpa_koreksi = round($nilais->jumlah_benar/($nilais->jumlah_benar+$nilais->jumlah_salah+$nilais->jumlah_kosong-5)*100, 2);
            $nilais->nilai_dengan_koreksi = round(($nilais->jumlah_benar-($nilais->jumlah_salah/(5-1)))/($nilais->jumlah_benar+$nilais->jumlah_salah+$nilais->jumlah_kosong-5)*100 ,2);
        }
        return Datatables::of($nilai)->make(true);
    }

    public function soal_individu($mapel_id, $id)
    {
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
}
