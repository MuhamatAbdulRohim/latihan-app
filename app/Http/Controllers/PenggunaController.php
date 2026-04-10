<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PenggunaController extends Controller
{
    public function index()
    {
        return view('daftar_pengguna');
    }

    public function create(Request $request)
    {
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
