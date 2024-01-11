<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndikatorController;

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

Route::get('/', function () {
    return view('index', [
        "title"=>"Beranda"
    ]);
});

// Route Resource For Unit Kerja
Route::resource('/data_audit/unit_kerja', UnitController::class);
Route::resource('/data_audit/indikator_unit_kerja', IndikatorController::class);
Route::resource('/data_audit/data_user_pengguna', UserController::class);

Route::get('/data_audit/indikator_unit_kerja/indikator', function() {
    return view('data_audit.indikator_unit_kerja.indikator', [
        "title" => "Indikator Unit Kerja"
    ]);
});

Route::get('/data_audit/data_user_pengguna/user', function(){
    return view('data_audit.data_user_pengguna.user', [
        "title" => "Data User"
    ]);
});

// Profile Pengguna
Route::get('/user_profile/profile', function(){
    return view('user_profile.profile', [
        "title" => "Profile User"
    ]);
});

Route::get('/jadwal', function(){
    return view('jadwal', [
        "title" => "Jadwal Pengisian"
    ]);
});

Route::get('/auth/login', function(){
    return view('auth.login');
});
