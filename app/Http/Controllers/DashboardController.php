<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
    	if (Auth::user()->level == "admin") {
    		
    	} 
    	elseif (Auth::user()->level == "siswa") {
    		
    	}
    	elseif (Auth::user()->level == "proktor" || Auth::user()->level == "guru") {
    		
    	}
	    return view('dashboard.testing');
    }
}
