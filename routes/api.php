<?php

use App\Http\Controllers\API\AuditeController;
use App\Http\Controllers\Api\AuditorController;
use App\Http\Controllers\Api\IndikatorKinerjaUnitKerjaController;
use App\Http\Controllers\Api\TestApiController;
use App\Http\Controllers\Api\UnitKerjaController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\DataAmiController\UnitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/test', [TestApiController::class, 'index']);
Route::get('/unit_kerja',[UnitKerjaController::class, 'index']);
Route::get('/auditor',[AuditorController::class, 'index']);
Route::get('/audite', [AuditeController::class, 'index']);
Route::get('/indikator_kinerja_unit_kerja', [IndikatorKinerjaUnitKerjaController::class, 'index']);
Route::get('/daftar_user',[UserController::class, 'index']);