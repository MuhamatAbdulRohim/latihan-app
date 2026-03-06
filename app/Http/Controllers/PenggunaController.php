<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index() {
        $pengguna  = Pengguna::all();
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
