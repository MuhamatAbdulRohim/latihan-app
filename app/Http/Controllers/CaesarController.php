<?php

namespace App\Http\Controllers;

use App\Services\CaesarCipherService;
use Illuminate\Http\Request;

class CaesarController extends Controller
{
    public function index($jenis = 'mentah')
    {
        if ($jenis == 'mentah') {
            return view('caesar');
        } elseif ($jenis == 'lumayan') {
            return view('caesar2');
        } else {
            return view('caesarJs');
        }
    }

    public function process(Request $request, CaesarCipherService $caesar)
    {
        // Validasi input
        $request->validate([
            'text' => 'required|string',
            'shift' => 'required|integer|min:1|max:25',
            'mode' => 'required'
        ]);

        if ($request->mode == 'encrypt') {
            $result = $caesar->encrypt($request->text, $request->shift);
        } else {
            $result = $caesar->decrypt($request->text, $request->shift);
        }

        return back()->with('result', $result);
    }

    public function processJson(Request $request, CaesarCipherService $caesar)
    {
        // Validasi input
        $request->validate([
            'text' => 'required|string',
            'shift' => 'required|integer|min:1|max:25',
            'mode' => 'required'
        ]);
        if ($request->mode == 'encrypt') {
            $result = $caesar->encrypt($request->text, $request->shift);
        } else {
            $result = $caesar->decrypt($request->text, $request->shift);
        }
        return response()->json(['result' => $result]);
    }
}
