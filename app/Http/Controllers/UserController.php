<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Pelajaran;
use App\Transformers\UserTransformer;
use DB;

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
}
