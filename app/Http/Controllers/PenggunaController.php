<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggunaController extends Controller
{
    public function index() {
        $pengguna  = DB::select('Select * from mahasiswa');
//        $pengguna = [["nama" => "Reyhan", "hoby" => "bacok orang"], ["nama" => "Jane", "hoby" => "main sama anak rpl"], ["nama" => "Abdis", "hoby" => "mengejar seseorang"]];
        return view('list_pengguna', compact('pengguna'));
    }

    public function create(Request $request) {
        try {
            Pengguna::create([
                'email' => $request->email,
                'password' => $request->password,
            ]);
            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back();
        }
    }
}
