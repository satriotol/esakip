<?php

use App\Http\Controllers\Api\DataUnitController;
use App\Http\Controllers\Api\EvaluasiKinerjaAkipController;
use App\Http\Controllers\Api\OpdController;
use App\Http\Controllers\Api\PelaporanKinerja\KotaLkjipController;
use App\Http\Controllers\Api\PelaporanKinerja\OpdLkjipController;
use App\Http\Controllers\Api\PerencanaanKinerjaKotaController;
use App\Http\Controllers\Api\PerencanaanKinerjaOpdController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('opd', [OpdController::class, 'index']);
Route::get('getApbdAnggaran', [DataUnitController::class, 'getApbdAnggaran']);
Route::get('getRealisasiAnggaran', [DataUnitController::class, 'getRealisasiAnggaran']);
Route::get('evaluasi_kinerja_akip', [EvaluasiKinerjaAkipController::class, 'index']);
Route::get('kotaLkjip', [KotaLkjipController::class, 'index']);
Route::get('opdLkjip', [OpdLkjipController::class, 'index']);


Route::get('perencanaankinerjakota/rkpd', [PerencanaanKinerjaKotaController::class, 'getRkpd']);
Route::get('perencanaankinerjakota/cascading_kinerja', [PerencanaanKinerjaKotaController::class, 'getCascadingKinerja']);

Route::get('perencanaankinerjaopd/renstra_period', [PerencanaanKinerjaOpdController::class, 'getRenstraPeriod']);
Route::get('perencanaankinerjaopd/renstra', [PerencanaanKinerjaOpdController::class, 'getRenstra']);
Route::get('perencanaankinerjaopd/rkt', [PerencanaanKinerjaOpdController::class, 'getRkt']);
Route::get('perencanaankinerjaopd/renja', [PerencanaanKinerjaOpdController::class, 'getRenja']);
Route::get('perencanaankinerjaopd/cascading_kinerja', [PerencanaanKinerjaOpdController::class, 'getCascadingKinerja']);
