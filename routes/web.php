<?php

use App\Http\Controllers\PenggunaController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/login', function () {
    return view('form_login');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/halo-maba-sti', [\App\Http\Controllers\PenggunaController::class, 'index']);
Route::post('/simpan-pengguna', [\App\Http\Controllers\PenggunaController::class, 'create']);
Route::get('/caesar/{jenis?}', [\App\Http\Controllers\CaesarController::class, 'index']);
Route::post('/caesar-process', [\App\Http\Controllers\CaesarController::class, 'process']);
Route::post('/caesar-process-json', [\App\Http\Controllers\CaesarController::class, 'processJson']);
// Route::get('/halo-maba-sti', function () {
//     return 'Halo dek';
// });
