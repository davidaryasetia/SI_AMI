<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ProfileAuditeController;
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
use App\Http\Controllers\DataAmiController\RiwayatController;
use App\Http\Controllers\DataAuditeController\PengisianKinerjaController;
use App\Http\Controllers\DataAuditeController\PersetujuanController;
use App\Http\Controllers\DataAuditeController\RekapCapaianController;
use App\Http\Controllers\DataAuditeController\RiwayatAuditeController;
use App\Http\Controllers\DataAuditorController\PengisianKinerjaAuditorController;
use App\Http\Controllers\DataAuditorController\RekapPersetujuanAuditorController;
use App\Http\Controllers\HomeController\HomeAuditeController;
use App\Http\Controllers\HomeController\HomeAuditorController;
use App\Http\Controllers\ImportDataController\ImportIndikatorKinerjaController;
use App\Http\Controllers\ImportDataController\ImportUnitController;
use App\Http\Controllers\YourController;
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

Route::middleware(['auth'])->group(function(){
    Route::get('/choose_role', [AuthController::class, 'chooseRole'])->name('choose.role');
    Route::post('/select_role', [AuthController::class, 'selectRole'])->name('select.role'); 
    Route::post('/switch-role', [AuthController::class, 'switchRole'])->name('switch.role');
    Route::resource('/profile', ProfileController::class);
    Route::get('/errors/403', function () {
        return view(view: 'errors.403');
    })->name('errors.403');
    
});

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('index', [
            'title' => 'Welcome'
        ]);
    });
    Route::get('/login', function () {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    })->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});
// Route untuk mengubah active_role
Route::post('/set-active-role', [YourController::class, 'setActiveRole'])->name('set-active-role');



Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:auditor'])->group(function () {
    Route::get('/home/auditor', [HomeAuditorController::class, 'HomeAuditor'])->name('home.auditor');
    Route::get('/home/auditor', [HomeAuditorController::class, 'HomeAuditor']);
    Route::resource('/pengisian_kinerja_auditor', PengisianKinerjaAuditorController::class );
    Route::get('/pengisian_kinerja_auditor', [PengisianKinerjaAuditorController::class, 'index'])->name('data_indikator_auditor.index');
    Route::resource('/rekap_persetujuan_auditor', RekapPersetujuanAuditorController::class);
});

Route::middleware(['auth', 'role:audite'])->group(function () {
    Route::get('/home/audite', [HomeAuditeController::class, 'HomeAudite'])->name('home.audite');
    Route::resource('/pengisian_kinerja', PengisianKinerjaController::class);
    Route::resource('/persetujuan', PersetujuanController::class);
    Route::get('/riwayat_audite', [RiwayatAuditeController::class, 'index'])->name('riwayat_audite.index');
}); 


// Auth Middleware
Route::middleware(['auth'])->group(function () {
    // Route Admin 
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('/home', HomeController::class);
        Route::resource('/data_unit', DataUnitController::class);
        Route::resource('/data_user', DataUserController::class);
        Route::post('/data_user/reset', [DataUserController::class, 'resetStatus'])->name('data_user.reset');
        Route::resource('/ploting_ami', PlotingAmiController::class);
        Route::post('/ploting_ami/reset', [PlotingAmiController::class, 'resetPloting'])->name('ploting_ami.reset');
        Route::post('/ploting_ami/cek-beban', [PlotingAmiController::class, 'cekBeban'])->name('ploting_ami.cek_beban');
        Route::resource('/data_indikator', DataIndikatorController::class);
        Route::get('/data_indikator/unit/create/{id}', [DataIndikatorController::class, 'create_ikuk_id']);
        Route::delete('data_indikator/delete/{indikator_id}/{unit_id}', [DataIndikatorController::class, 'destroyWithUnit'])->name('data_indikator.destroyWithUnit');
        Route::resource('/daftar_auditor', AuditorController::class);
        Route::resource('/periode_audit', PeriodeAuditController::class);
        Route::post('/periode_audit/close/{id}', [PeriodeAuditController::class, 'close'])->name('periode_audit.close');
        Route::resource('/progres_audit', ProgresAuditController::class);
        Route::resource('/rekap_audit', RekapAuditController::class);
        Route::post('/import_Indikator_Kinerja_Unit', [ImportIndikatorKinerjaController::class, 'importData'])->name('import.dataIndikator');
        Route::post('/import_Unit_Kerja', [ImportUnitController::class, 'importDataUnit'])->name('import.dataUnit');
        Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
    });
});

