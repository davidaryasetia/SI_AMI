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
    return view('index');
});

// Route For Unit Kerja
Route::get('/unit', [UnitController::class, 'unit']);
Route::get('/add_unit', [UnitController::class, 'add_unit'])->name('add_unit');
Route::post('/store', [UnitController::class, 'store'])->name('store');
Route::get('/unit', [UnitController::class, 'unit'])->name('unit');
Route::get('/edit', [UnitController::class], 'edit')->name('edit');

Route::get('/indikator', function() {
    return view('indikator');
});

Route::get('/jadwal', function(){
    return view('jadwal');
});

Route::get('/profile', function(){
    return view('profile');
});


Route::get('/daftar_user', function(){
    return view('daftar_user');
});
Route::get('/login', function(){
    return view('login');
});
