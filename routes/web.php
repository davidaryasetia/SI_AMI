<?php

use App\Http\Controllers\Auth\DaftarUserController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DataAmiController\AuditeController;
use App\Http\Controllers\DataAmiController\AuditorController;
use App\Http\Controllers\DataAmiController\IndikatorKinerjaController;
use App\Http\Controllers\DataAmiController\JadwalAmiController;
use App\Http\Controllers\DataAmiController\UnitBranchController;
use App\Http\Controllers\DataAmiController\UnitController;
use App\Http\Controllers\HomeController\BerandaController;
use App\Http\Controllers\ImportController;
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

// Route::get('/', function () {
//     return view('index', [
//         "title" => "Beranda"
//     ]);
// });

// Route::get('/', ['LoginController::class', 'index'])->name('loginForm');
Route::resource('/', BerandaController::class);

// Make New Route Resource 
Route::resource('/unit_kerja', UnitController::class);
Route::resource('/unit_branch', UnitBranchController::class);
Route::resource('/indikator_unit_kerja', IndikatorKinerjaController::class);
Route::resource('/daftar_auditor', AuditorController::class);
Route::resource('/daftar_audite', AuditeController::class);
Route::resource('/jadwal_ami', JadwalAmiController::class);
Route::resource('/profile', ProfileController::class);
Route::resource('/daftar_user', DaftarUserController::class);
Route::post('/import-data', [ImportController::class, 'importData'])->name('import.data');