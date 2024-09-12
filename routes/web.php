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
use App\Http\Controllers\ImportDataController\ImportIndikatorKinerjaController;
use App\Http\Controllers\ImportDataController\ImportUnitController;
use App\Models\IndikatorKinerjaKegiatan;
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
Route::get('/', function(){
    return view('index',[
        'title' => 'Dashboard'
    ]);
});

Route::get('/login', function(){
    return view('auth.login', [
        'title' => 'Login'
    ]);
});

Route::resource('/home', BerandaController::class);

// Make New Route Resource 
Route::resource('/unit_kerja', UnitController::class);
Route::resource('/unit_branch', UnitBranchController::class);

// Indikator Kinerja Controller 
Route::resource('/indikator_unit_kerja', IndikatorKinerjaController::class);
Route::get('/indikator_unit_kerja/unit/create/{id}', [IndikatorKinerjaController::class, 'create_ikuk_id']);
Route::delete('indikator_unit_kerja/delete/{indikator_id}/{unit_id}', [IndikatorKinerjaController::class, 'destroyWithUnit'])->name('indikator_unit_kerja.destroyWithUnit');


Route::resource('/daftar_auditor', AuditorController::class);
Route::resource('/daftar_audite', AuditeController::class);
Route::resource('/jadwal_ami', JadwalAmiController::class);
Route::resource('/profile', ProfileController::class);
Route::resource('/daftar_user', DaftarUserController::class);
Route::post('/import_Indikator_Kinerja_Unit', [ImportIndikatorKinerjaController::class, 'importData'])->name('import.data');
Route::post('/import_Unit_Kerja', [ImportUnitController::class, 'importDataUnit'])->name('import.dataUnit');