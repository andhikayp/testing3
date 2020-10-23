<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\User;
use App\Models\Pelajaran;
use App\Transformers\UserTransformer;
use DB;
use App\Models\User;
use App\Models\Sekolah;
use DataTables;
// use App\Http\Requests\Admin\UserRequest;
use Uuid;

class UserController extends Controller
{
    public function users(User $user)
    {
        $users = $user->all();
        return fractal()
            ->collection($users)
            ->transformWith(new UserTransformer)
            ->toArray();
        // return response()->json($users);
    }

    public function pelajaran()
    {
    	$pelajaran = Pelajaran::all();
        return response()->json($pelajaran);
    }

    public function admindt()
    {
    	$data['results'] = DB::select( DB::raw("SELECT * FROM kelas WHERE gelombang = 2 LIMIT 5"));
    	foreach ($data['results'] as $result) {
    		$result->logbook = DB::select( DB::raw("SELECT * FROM logbook l WHERE l.kode_rombel='$result->kode_rombel'"));
    	}
    	return response()->json($data);
    }

    public function testing_db()
    {
        $desc = "Menggunakan bahasa yang tidak sesuai dengan kaidah bahasa Indonesia, untuk bahasa daerah dan bahasa asing tidak sesuai kaidahnya.";
        // $data = DB::connection('mysql2')->select("SELECT * from komentars where id = ?", [1]);
        $data = DB::connection('mysql2')->select("SELECT * from komentar_telaahs where komentar like ?", [$desc]);
        dd($data);
    }

    public function datatables(Request $request)
    {
        //Isi dengan kolom
        $columns = array(
            0 => 'nama',
            1 => 'username',
            2 => 'level',
            3 => 'action'
        );

        //<-- Gak Perlu Diubah -->
        $totalData = count(User::where('level', '!=', 'siswa')->get());

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $users = User::where('level', '!=', 'siswa')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            //<-- Gak Perlu Diubah END -->
            //Tambah orWhere di kolom yang akan dijadikan di search
            $users =  User::where('level', '!=', 'siswa')
                ->where(function ($q) use ($search) {
                    $q->where('nama', 'LIKE', "%{$search}%")
                        ->orWhere('username', 'LIKE', "%{$search}%")
                        ->orWhere('level', 'LIKE', "%{$search}%")
                        ->orWhereHas('sekolah', function ($query) use ($search) {
                            $query->where('nama', 'LIKE', "%{$search}%");
                        });
                })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            //Tambah orWhere di kolom yang akan dijadikan di search
            $totalFiltered = User::where('level', 'siswa')
                ->where(function ($q) use ($search) {
                    $q->where('nama', 'LIKE', "%{$search}%")
                        ->orWhere('username', 'LIKE', "%{$search}%")
                        ->orWhere('level', 'LIKE', "%{$search}%")
                        ->orWhereHas('sekolah', function ($query) use ($search) {
                            $query->where('nama', 'LIKE', "%{$search}%");
                        });
                })
                ->count();
        }

        $data = array();
        if (!empty($users)) {
            foreach ($users as $user) {
                //Apa yang akan ditampilkan di tiap2 row
                $nestedData['nama'] = $user->nama;
                $sekolah = Sekolah::find($user->sekolah_id);
                if ($user->sekolah) {
                    $sekolah = $user->sekolah->nama;
                } else {
                    $sekolah = 'Data Sekolah Siswa Belum Terinput';
                }
                $nestedData['sekolah'] = $sekolah;
                $nestedData['username'] = $user->username;
                $nestedData['level'] = $user->level;
                $nestedData['action'] = '<a href="/users/' . $user->id . '/edit"><button class="btn bg-blue edit"><i class="material-icons">mode_edit</i><span>Edit</span></button></a>
                    </button><button class="btn bg-red delete" data-toggle="modal" data-target="#ModalDelete" onclick="deleteClickFunction(\'' . $user->username . '\', \'' . $user->id . '\')" ><i class="material-icons">delete</i><span>Hapus</span></button>';

                // ID setter, untuk keperluan ajax delete
                $nestedData['DT_RowId'] = $user->id;

                $data[] = $nestedData;
            }
        }

        //<-- Gak Perlu Diubah -->
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        // return json_encode($json_data);
        return response()->json($json_data);
        //<-- Gak Perlu Diubah END -->
    }

    public function tes_yajra()
    {
        return Datatables::of(User::select('nama','jenis_kelamin','nisn','username')->where('level', 'siswa'))->make(true);
    }
}
