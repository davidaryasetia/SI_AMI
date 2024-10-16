<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DataAmiController\DataUserController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\DataAmiController\AuditorController;
use App\Http\Controllers\DataAmiController\DataIndikatorController;
use App\Http\Controllers\DataAmiController\DataUnitController;
use App\Http\Controllers\DataAmiController\HomeController;
use App\Http\Controllers\DataAmiController\PeriodeAuditController;
use App\Http\Controllers\DataAmiController\PlotingAmiController;
use App\Http\Controllers\DataAmiController\ProgresAuditController;
use App\Http\Controllers\DataAmiController\RekapAuditController;
use App\Http\Controllers\HomeController\HomeBaseController;
use App\Http\Controllers\ImportDataController\ImportIndikatorKinerjaController;
use App\Http\Controllers\ImportDataController\ImportUnitController;
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
        'title' => 'Welcome'
    ]);
});

Route::middleware(['guest'])->group(function () {

});

// Login
Route::get('/login', function () {
    return view('auth.login', [
        'title' => 'Login'
    ]);
})->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

 // Route Sementara 
 Route::middleware(['role:audite'])->group(function () {
    Route::get('/home/audite', [HomeBaseController::class, 'HomeAudite'])->name('home.audite');
});

Route::middleware(['role:auditor'])->group(function () {
    Route::get('/home/auditor', [HomeBaseController::class, 'HomeAuditor'])->name('home.auditor');
});

 
// Auth Middleware
Route::middleware(['auth'])->group(function () {
    // Route Admin 
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('/home', HomeController::class);
        Route::resource('/data_unit', DataUnitController::class);
        Route::resource('/data_user', DataUserController::class);
        Route::resource('/ploting_ami', PlotingAmiController::class);
        Route::resource('/data_indikator', DataIndikatorController::class);
        Route::get('/data_indikator/unit/create/{id}', [DataIndikatorController::class, 'create_ikuk_id']);
        Route::delete('data_indikator/delete/{indikator_id}/{unit_id}', [DataIndikatorController::class, 'destroyWithUnit'])->name('data_indikator.destroyWithUnit');
        Route::resource('/daftar_auditor', AuditorController::class);
        Route::resource('/periode_audit', PeriodeAuditController::class);
        Route::resource('/profile', ProfileController::class);
        Route::resource('/progres_audit', ProgresAuditController::class);
        Route::resource('/rekap_audit', RekapAuditController::class);
        Route::post('/import_Indikator_Kinerja_Unit', [ImportIndikatorKinerjaController::class, 'importData'])->name('import.dataIndikator');
        Route::post('/import_Unit_Kerja', [ImportUnitController::class, 'importDataUnit'])->name('import.dataUnit');
    });
    
    
});

// Administrator

// Route::resource('/data_unit', DataUnitController::class);
// Route::resource('/data_user', DataUserController::class);
// Route::resource('/ploting_ami', PlotingAmiController::class);
// Route::resource('/data_indikator', DataIndikatorController::class);
// Route::get('/data_indikator/unit/create/{id}', [DataIndikatorController::class, 'create_ikuk_id']);
// Route::delete('data_indikator/delete/{indikator_id}/{unit_id}', [DataIndikatorController::class, 'destroyWithUnit'])->name('data_indikator.destroyWithUnit');
// Route::resource('/daftar_auditor', AuditorController::class);
// Route::resource('/periode_audit', PeriodeAuditController::class);
// Route::resource('/profile', ProfileController::class);
// Route::resource('/progres_audit', ProgresAuditController::class);
// Route::resource('/rekap_audit', RekapAuditController::class);
// Route::post('/import_Indikator_Kinerja_Unit', [ImportIndikatorKinerjaController::class, 'importData'])->name('import.dataIndikator');
// Route::post('/import_Unit_Kerja', [ImportUnitController::class, 'importDataUnit'])->name('import.dataUnit');