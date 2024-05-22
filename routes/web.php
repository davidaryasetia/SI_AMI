<?php

use App\Http\Controllers\Auth\DaftarUserController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\DataAmiController\IndikatorKinerjaController;
use App\Http\Controllers\DataAmiController\JadwalAmiController;
use App\Http\Controllers\DataAmiController\UnitBranchController;
use App\Http\Controllers\DataAmiController\UnitController;
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

Route::get('/', function () {
    return view('index', [
        "title" => "Beranda"
    ]);
});

// Make New Route Resource 
Route::resource('/unit_kerja', UnitController::class);
Route::resource('/unit_branch', UnitBranchController::class);
Route::resource('/indikator_unit_kerja', IndikatorKinerjaController::class);
Route::resource('/jadwal_ami', JadwalAmiController::class);
Route::resource('/profile', ProfileController::class);
Route::resource('/daftar_user', DaftarUserController::class);



// Route Resource For Unit Kerja
// Route::resource('/unit_kerja', UnitController::class);
// Route::resource('/indikator_unit_kerja', IndikatorController::class);
// Route::resource('/data_user_pengguna', UserController::class);

// // Route Resource
// Route::get('/data_audit/indikator_unit_kerja/indikator', function () {
//     return view('data_audit.indikator_unit_kerja.indikator', [
//         "title" => "Indikator Unit Kerja"
//     ]);
// });

// Route::get('/data_user_pengguna', function () {
//     return view('data_audit.data_user_pengguna.user', [
//         "title" => "Data User"
//     ]);
// });

// // Profile Pengguna
// Route::get('/profile', function () {
//     return view('profile.profile', [
//         "title" => "Profile User"
//     ]);
// });

// Route::get('/jadwal', function () {
//     return view('jadwal', [
//         "title" => "Jadwal Pengisian"
//     ]);
// });

// Route::get('/login', function () {
//     return view('auth.login');
// });
