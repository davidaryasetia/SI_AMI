<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;

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

// Route For Unit Kerja

Route::get('/add_unit', [UnitController::class, 'add_unit'])->name('add_unit');
Route::post('/store', [UnitController::class, 'store'])->name('store');
Route::get('/unit', [UnitController::class, 'unit'])->name('unit');
Route::get('/edit', [UnitController::class], 'edit')->name('edit');

Route::get('/indikator', function() {
    return view('indikator', [
        "title" => "Indikator Unit Kerja"
    ]);
});

Route::get('/data_user', function(){
    return view('data_user', [
        "title" => "Data User"
    ]);
});

Route::get('/profile', function(){
    return view('profile', [
        "title" => "Profile User"
    ]);
});

Route::get('/jadwal', function(){
    return view('jadwal', [
        "title" => "Jadwal Pengisian"
    ]);
});

Route::get('/login', function(){
    return view('login');
});
