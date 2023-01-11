<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DataUnitController;
use App\Http\Controllers\Api\EvaluasiKinerjaAkipController;
use App\Http\Controllers\Api\OpdController;
use App\Http\Controllers\Api\OpdPenilaianController;
use App\Http\Controllers\Api\OpdPerjanjianKinerjaController;
use App\Http\Controllers\Api\PelaporanKinerja\KotaLkjipController;
use App\Http\Controllers\Api\PelaporanKinerja\OpdLkjipController;
use App\Http\Controllers\Api\PengukuranKinerjaKotaController;
use App\Http\Controllers\Api\PengukuranKinerjaOpdController;
use App\Http\Controllers\Api\PerencanaanKinerjaKotaController;
use App\Http\Controllers\Api\PerencanaanKinerjaOpdController;
use App\Http\Controllers\Api\RencanaAksiController;
use App\Http\Controllers\Api\SkpdController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('v2/rencanaAksi', [RencanaAksiController::class, 'index_v2']);
    Route::get('opdPenilaian', [OpdPenilaianController::class, 'index'])->name('getOpdPenilaian');
    Route::get('opdPenilaian/getPenyerapanAnggaranBelanja', [OpdPenilaianController::class, 'getPenyerapanAnggaranBelanja'])->name('getPenyerapanAnggaranBelanja');
    Route::get('opdPenilaian/getp3dn', [OpdPenilaianController::class, 'getp3dn'])->name('getp3dn');
});
Route::get('opd', [OpdController::class, 'index']);
Route::get('skpd', [SkpdController::class, 'getSkpd']);
Route::get('getApbdAnggaran', [DataUnitController::class, 'getApbdAnggaran']);
Route::get('getApbdAnggaran/export', [DataUnitController::class, 'getApbdAnggaranExport'])->name('getApbdAnggaranExport');
Route::get('getRealisasiAnggaran', [DataUnitController::class, 'getRealisasiAnggaran']);
Route::get('getRealisasiAnggaran/export', [DataUnitController::class, 'getRealisasiAnggaranExport'])->name('getRealisasiAnggaranExport');
Route::get('evaluasi_kinerja_akip', [EvaluasiKinerjaAkipController::class, 'index']);
Route::get('kotaLkjip', [KotaLkjipController::class, 'index']);
Route::get('opdLkjip', [OpdLkjipController::class, 'index']);


Route::get('perencanaankinerjakota/rpjmd', [PerencanaanKinerjaKotaController::class, 'getRpjmd']);
Route::get('perencanaankinerjakota/rkpd', [PerencanaanKinerjaKotaController::class, 'getRkpd']);
Route::get('perencanaankinerjakota/cascading_kinerja', [PerencanaanKinerjaKotaController::class, 'getCascadingKinerja']);

Route::get('perencanaankinerjaopd/renstra_period', [PerencanaanKinerjaOpdController::class, 'getRenstraPeriod']);
Route::get('perencanaankinerjaopd/renstra', [PerencanaanKinerjaOpdController::class, 'getRenstra']);
Route::get('perencanaankinerjaopd/rkt', [PerencanaanKinerjaOpdController::class, 'getRkt']);
Route::get('perencanaankinerjaopd/renja', [PerencanaanKinerjaOpdController::class, 'getRenja']);
Route::get('perencanaankinerjaopd/cascading_kinerja', [PerencanaanKinerjaOpdController::class, 'getCascadingKinerja']);

Route::get('pengukurankinerjakota/iku', [PengukuranKinerjaKotaController::class, 'getIku']);
Route::get('pengukurankinerjakota/perjanjian_kinerja', [PengukuranKinerjaKotaController::class, 'getPerjanjianKinerja']);
Route::get('pengukurankinerjaopd/iku', [PengukuranKinerjaOpdController::class, 'getIku']);
Route::get('pengukurankinerjaopd/perjanjian_kinerja', [PengukuranKinerjaOpdController::class, 'getPerjanjianKinerja']);


Route::get('perjanjianKinerja', [OpdPerjanjianKinerjaController::class, 'index']);
Route::get('perjanjianKinerja/getProgramAnggaran', [OpdPerjanjianKinerjaController::class, 'getProgramAnggaran'])->name('getProgramAnggaran');
Route::get('rencanaAksi', [RencanaAksiController::class, 'index']);
