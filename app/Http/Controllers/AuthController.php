<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\UserTransformer;
use Illuminate\Support\Facades\Auth;
use App\Models\UjianSiswa;
use App\Models\User;
use App\Models\Sekolah;
use App\Models\EncryptionKey;
use Carbon\Carbon;
use Hash;

class AuthController extends Controller
{
    public function home()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $users = User::where('username', $request->input('username'))->get();
        // $tes = Hash::make('fawwaz');
        foreach ($users as $user) 
        {
            if(Hash::check($request->input('password'),$user->password)) {
                Auth::loginUsingId($user->id, TRUE);
                return redirect('/dashboard');
            }
        }
        return redirect('/')->with('error','Username atau Password salah!');
    }

    public function testing_auth()
    {
        dd(Auth::user());
    }

    public function logout(Request $request)
    {
        $user = Auth::User();
        Auth::logout();
        return redirect('/')->with('success','logout berhasil');
    }

    public function ssp()
    {
        return view('auth.testing');        
    }
}
