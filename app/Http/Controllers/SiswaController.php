<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KabKota;
use DataTables;
use App\Models\Sekolah;
use App\Models\User;
use DB;

class SiswaController extends Controller
{
    public function index()
    {
        return view('siswa.index');
    }

    public function ajaxIndex()
    {
    	$kota = KabKota::select('kd_rayon','nama')->orderBy('kd_rayon')->get();
        return Datatables::of($kota)->make(true);
    }

    public function ajaxSekolah($param, $id)
    {
        $kode_kota = '__'.$id.'%'; 
        $sekolah = Sekolah::where('kode','LIKE',$kode_kota)->orderBy('created_at', 'asc')->get();
        if ($param == 'nilai') {
            return Datatables::of($sekolah)
            	->addColumn('action', function ($user) {
                    return '<a href="'.url('nilai', $user->id).'"><button type="button" class="btn btn-primary bg-gd-primary min-width-75">Lihat Detail</button></a>';
                })
                ->rawColumns(['action'])
            	->make(true);
        } elseif ($param == 'siswa') {
            foreach($sekolah as $s){
                $s->jumlah_siswa = User::where('level', 'siswa')->where('sekolah_id', $s->id)->count();
            }
            return Datatables::of($sekolah)
                ->addColumn('action', function ($user) {
                    return '<a href="'.url('siswa', $user->id).'"><button type="button" class="btn btn-primary bg-gd-primary min-width-75">Lihat Detail</button></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function siswa($id)
    {
        $sekolah = Sekolah::where('id',$id)->first();
        return view('siswa.view', compact('sekolah'));
    }

    public function ajaxSiswa($param, $id)
    {
    	$siswa = User::where('sekolah_id', $id)->where('level','siswa')->get();
        if ($param == 'nilai') {
            return Datatables::of($siswa)
                ->addColumn('action', function ($user) {
                    return '<a href="'.url('nilai', ['sekolah' => $user->sekolah_id, 'id' => $user->id]).'"><button type="button" class="btn btn-primary bg-gd-primary min-width-75">Lihat Detail</button></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } elseif ($param == 'siswa') {
            return Datatables::of($siswa)->make(true);
        }
    }

    public function ajaxSiswaGrafik($id)
    {
    	$data['jenis_kelamin'] = DB::table('user')
        	->select('jenis_kelamin', DB::raw('count(*) as total'))
        	->where('sekolah_id', $id)
        	->where('level','siswa')
          	->groupBy('jenis_kelamin')
           	->get();
    	$data['jurusan'] = DB::table('user')
        	->select('jurusan', DB::raw('count(*) as total'))
        	->where('sekolah_id', $id)
        	->where('level','siswa')
          	->groupBy('jurusan')
           	->get();
        return response()->json($data);
    }
}