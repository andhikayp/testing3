<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Carbon\Carbon;
use App\Models\JadwalUjian;
use App\Models\UjianSiswa;
use App\Models\Paket;
use App\Models\User;

class UjianController extends Controller
{
    public function index()
    {
        return view('ujian.index');
    }
    // (string)$user->date->isoFormat('dddd, D MMMM Y')
    // \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y')

    public function ajaxUjian(){
        if(Auth()->user()->level == 'admin'){
        	$ujian = DB::table('jadwal_ujian')
        		->select(DB::raw('DATE(waktu_mulai) as date'), DB::raw('count(*) as pelaksanaan'))
          		->groupBy(DB::raw('DATE(waktu_mulai)'))
                ->orderBy('date', 'asc')
          		->get();
        } elseif(Auth()->user()->level == 'proktor') {
            $pelajaran = $this->getPelajaranId();
            $ujian = DB::table('jadwal_ujian')
                ->select(DB::raw('DATE(waktu_mulai) as date'), DB::raw('count(*) as pelaksanaan'))
                ->whereIn('pelajaran_id', $pelajaran)
                ->groupBy(DB::raw('DATE(waktu_mulai)'))
                ->orderBy('date', 'asc')
                ->get();
        }
      	$tanggal = "2020-03-02";
        return Datatables::of($ujian)
        	->addColumn('tanggal', function ($user) {
        		$tanggal = \Carbon\Carbon::parse($user->date)->locale('id')->isoFormat('dddd, D MMMM Y');
                return $tanggal;
            })
        	->make(true);
    }

    public function jsonUjian(){
        if(Auth()->user()->level == 'admin'){
            $ujian = DB::table('jadwal_ujian')
                ->select(DB::raw('DATE(waktu_mulai) as date'), DB::raw('count(*) as pelaksanaan'))
                ->groupBy(DB::raw('DATE(waktu_mulai)'))
                ->orderBy('date', 'asc')
                ->get();
        } elseif(Auth()->user()->level == 'proktor') {
            $pelajaran = $this->getPelajaranId();
            $ujian = DB::table('jadwal_ujian')
                ->select(DB::raw('DATE(waktu_mulai) as date'), DB::raw('count(*) as pelaksanaan'))
                ->whereIn('pelajaran_id', $pelajaran)
                ->groupBy(DB::raw('DATE(waktu_mulai)'))
                ->orderBy('date', 'asc')
                ->get();
        } 
        foreach ($ujian as $u) {
            $u->tanggal = \Carbon\Carbon::parse($u->date)->locale('id')->isoFormat('dddd, D MMMM Y');
        }
        return response()->json([
            'code' => 400,
            'message' => "Data Kosong",
            'data' => $ujian
        ]);
    }
        // return response()->json($ujian);

    public function ajaxUjianTanggal($id)
    {
        if(Auth()->user()->level == 'admin'){
        	$ujianTanggal = JadwalUjian::whereDate('waktu_mulai', $id)->get(); 
        } elseif(Auth()->user()->level == 'proktor') {
            $pelajaran = $this->getPelajaranId();
            $ujianTanggal = JadwalUjian::whereDate('waktu_mulai', $id)
                    ->whereIn('pelajaran_id', $pelajaran)
                    ->get(); 
        }
        return Datatables::of($ujianTanggal)->make(true);
    }

    public function ajaxCountUjian()
    {
        $count_ujian = UjianSiswa::count();
        return response()->json($count_ujian);
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
