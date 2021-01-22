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
use App\Models\Pelajaran;
use Ramsey\Uuid\Uuid;

class UjianController extends Controller
{
    public function index(){
        return view('ujian.index');
    }

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
        return response()->json($ujian);
    }

    public function ajaxUjianTanggal($id){
        if(Auth()->user()->level == 'admin'){
        	$ujianTanggal = JadwalUjian::whereDate('waktu_mulai', $id)->get(); 
        } elseif(Auth()->user()->level == 'proktor') {
            $pelajaran = $this->getPelajaranId();
            $ujianTanggal = JadwalUjian::whereDate('waktu_mulai', $id)
                    ->whereIn('pelajaran_id', $pelajaran)
                    ->get(); 
        }
        foreach($ujianTanggal as $ujian){
            list($kategori, $mata_pelajaran, $peminatan, $kurikulum, $pelaksanaan, $sesi) = explode("|",$ujian->deskripsi);
            $ujian->deskripsi = $mata_pelajaran;
            $ujian->kurikulum = $kurikulum;
            $ujian->pelaksanaan = $pelaksanaan;
            $ujian->durasi = strval($ujian->durasi)." menit";
        }
        return Datatables::of($ujianTanggal)
            ->addColumn('action', function ($ujian) {
                date_default_timezone_set("Asia/Bangkok");
                $today = date("Y-m-d H:i:s");
                if($ujian->waktu_mulai > $today){
                    return '
                    <div style="width:165px;">
                        <a href="" class="button text-center mr-2 btn btn-danger bg-gd-danger min-width-75 float-right" data-id="'.$ujian->id.'">Hapus</a>
                        <a href="'.url('ujian/edit/', $ujian->id).'"><button type="button" class="delete text-center mr-2 btn btn-warning bg-gd-warning min-width-75 float-right" id="'.$ujian->id.'">Edit</button></a>
                    </div>';
                } else{
                    return '
                    <div style="width:165px;">
                        <div class="mr-2 btn btn-success bg-gd-success min-width-75 float-right text-center">Ujian Terlaksana</div>
                    </div>';
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function ajaxCountUjian(){
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

    public function tambahUjian(){
        $mapel = Pelajaran::all()->sortBy('kurikulum');
        return view('ujian.tambah', compact('mapel'));
    }

    public function saveUjian(Request $r){
        $jadwal = new JadwalUjian();
        $jadwal->id = Uuid::uuid4()->toString();
        $pelajaran = Pelajaran::find($r->pelajaran);
        if(!$pelajaran) {
            return redirect()->back()->with('error', 'Pelajaran Tidak Ditemukan!');
        }
        $jadwal->deskripsi = strtoupper("UMUM|".$pelajaran->nama."|UMUM|".$pelajaran->kurikulum."|".$r->kategori."|".$r->sesi);
        $jadwal->sesi = $r->sesi;
        $jadwal->waktu_mulai = date('Y-m-d H:i:s', strtotime("$r->date $r->waktu_mulai"));
        date_default_timezone_set("Asia/Bangkok");
        $today = date("Y-m-d H:i:s");
        if($jadwal->waktu_mulai < $today){
            return redirect()->back()->with('error', 'Tanggal Pelaksanaan Ujian Telah Berlalu!');
        }
        $jadwal->waktu_selesai = date('Y-m-d H:i:s', strtotime($jadwal->waktu_mulai)+($r->durasi*60));
        $jadwal->durasi = $r->durasi;
        if($jadwal->sesi > 180) {
            return redirect()->back()->with('error', 'Waktu Pelaksanaan Ujian Sangat Lama!');
        }
        $jadwal->pelajaran_id = $r->pelajaran;
        $jadwal->string_hook = "risetalien";
        $jadwal->tipe_ujian = "Online";
        $jadwal->save();
        return redirect('/ujian')->with('success', 'Jadwal Pelaksanaan Ujian Berhasil Ditambahkan!');
    }

    public function editUjian($id){
        $mapel = Pelajaran::all()->sortBy('kurikulum');
        $ujian = JadwalUjian::find($id)->first();
        if($ujian){
            return view('ujian.edit', compact('mapel', 'ujian'));
        } else{
            return redirect()->back()->with('error', 'Jadwal Ujian yang Dipilih Tidak Ditemukan');
        }
    }

    public function hapusUjian(Request $r){
        JadwalUjian::find($r->id)->delete();
        return response()->json(array('success' => true));
    }
}
