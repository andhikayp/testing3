<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Carbon\Carbon;
use App\Models\JadwalUjian;
use App\Models\UjianSiswa;

class UjianController extends Controller
{
    public function index()
    {
        return view('ujian.index');
    }
    // (string)$user->date->isoFormat('dddd, D MMMM Y')
    // \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y')

    public function ajaxUjian()
    {
    	$ujian = DB::table('jadwal_ujian')
    		->select(DB::raw('DATE(waktu_mulai) as date'), DB::raw('count(*) as pelaksanaan'))
      		->groupBy(DB::raw('DATE(waktu_mulai)'))
      		->get();
      	$tanggal = "2020-03-02";
        return Datatables::of($ujian)
        	->addColumn('tanggal', function ($user) {
        		$tanggal = \Carbon\Carbon::parse($user->date)->locale('id')->isoFormat('dddd, D MMMM Y');
                return $tanggal;
            })
        	->make(true);
    }

    public function jsonUjian()
    {
        $ujian = DB::table('jadwal_ujian')
            ->select(DB::raw('DATE(waktu_mulai) as date'), DB::raw('count(*) as pelaksanaan'))
            ->groupBy(DB::raw('DATE(waktu_mulai)'))
            ->get();
        foreach ($ujian as $u) {
            $u->tanggal = \Carbon\Carbon::parse($u->date)->locale('id')->isoFormat('dddd, D MMMM Y');
        }
        return response()->json($ujian);
    }

    public function ajaxUjianTanggal($id)
    {
    	$ujianTanggal = JadwalUjian::whereDate('waktu_mulai', $id)->get(); 
        return Datatables::of($ujianTanggal)->make(true);
    }

    public function ajaxCountUjian()
    {
        $count_ujian = UjianSiswa::count();
        return response()->json($count_ujian);
    }
}
