<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Paket;
use App\Models\Sekolah;
use App\Models\UjianSiswa;
use App\Models\Pelajaran;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = DB::table('user')
                ->select('level', DB::raw('count(*) as total'))
                ->groupBy('level')
                ->get();
        $sekolah = Sekolah::count();
        $pelajaran = Pelajaran::count();
        
    	if (Auth::user()->level == "admin") {
            
    	} 
    	elseif (Auth::user()->level == "siswa") {
    		
    	}
    	elseif (Auth::user()->level == "proktor" || Auth::user()->level == "guru") {
    		
    	}
	    return view('dashboard.testing', compact('user','sekolah','pelajaran'));
    }
}
