<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $data = Mahasiswa::all();
        return view('mahasiswa.index', compact('data'));
    }

    public function store(Request $request)
    {
        Mahasiswa::create($request->all());

        return redirect('/mahasiswa')
            ->with('success','Data berhasil ditambah');
    }

    public function edit($id)
    {
        $edit = Mahasiswa::find($id);
        $data = Mahasiswa::all();

        return view('mahasiswa.index',compact('data','edit'));
    }

    public function update(Request $request,$id)
    {
        Mahasiswa::find($id)->update($request->all());

        return redirect('/mahasiswa')
            ->with('success','Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Mahasiswa::find($id)->delete();

        return redirect('/mahasiswa')
            ->with('success','Data berhasil dihapus');
    }
}
