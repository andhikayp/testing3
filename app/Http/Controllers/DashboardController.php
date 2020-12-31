<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Paket;
use App\Models\Sekolah;
use App\Models\UjianSiswa;
use App\Models\Pelajaran;
use App\Models\KabKota;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->level == "admin") {
            $user = DB::table('user')
                    ->select('level', DB::raw('count(*) as total'))
                    ->groupBy('level')
                    ->get();
            $sekolah = Sekolah::count();
            $pelajaran = Pelajaran::count();
            $kurikulum = Pelajaran::distinct('kurikulum')->count('kurikulum');
            $kota = KabKota::count();
            return view('dashboard.testing', compact('user','sekolah','pelajaran', 'kurikulum', 'kota'));
    	} 
    	elseif (Auth::user()->level == "siswa") {
    		
    	}
    	elseif (Auth::user()->level == "proktor" || Auth::user()->level == "guru") {
            $sekolah_id = Auth()->user()->sekolah_id;
            $user = User::where('level', 'siswa')->where('sekolah_id', $sekolah_id)->count();
            $ujian = UjianSiswa::whereIn('user_id', function($query) use ($sekolah_id){
                $query->select('id')->from(with(new User)->getTable())->where('sekolah_id', $sekolah_id);
            })->count();
            $pelajaran = Paket::select('pelajaran_id')->whereIn('id', function($query) use ($sekolah_id){
                $query->select('paket_id')->from(with(new UjianSiswa)->getTable())->whereIn('user_id', function($query2) use ($sekolah_id){
                    $query2->select('id')->from(with(new User)->getTable())->where('sekolah_id', $sekolah_id);
                })->distinct('paket_id')->get();
            })->distinct('pelajaran_id')->get()->count();
            return view('dashboard.testing', compact('user','ujian','pelajaran'));
    	}
    }
}
