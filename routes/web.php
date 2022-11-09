<?php

use App\Http\Controllers\CaptchaServiceController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/reload-captcha', [CaptchaServiceController::class, 'reloadCaptcha']);

Route::prefix('administrator')->group(__DIR__ . '/adminRoutes.php');
Route::get('/', [IndexController::class, 'home'])->name('home');
Route::get('/pelaporan_kinerja', [IndexController::class, 'pelaporan_kinerja'])->name('pelaporan_kinerja');
Route::get('/perencanaan_kinerja_kota', [IndexController::class, 'perencanaan_kinerja_kota'])->name('perencanaan_kinerja_kota');
Route::get('/perencanaan_kinerja_opd', [IndexController::class, 'perencanaan_kinerja_opd'])->name('perencanaan_kinerja_opd');

Route::get('/pengukuran_kinerja_kota', [IndexController::class, 'pengukuran_kinerja_kota'])->name('pengukuran_kinerja_kota');
Route::get('/pengukuran_kinerja_opd', [IndexController::class, 'pengukuran_kinerja_opd'])->name('pengukuran_kinerja_opd');


Route::get('/capaian_kinerja', [IndexController::class, 'capaian_kinerja'])->name('capaian_kinerja');
Route::get('/evaluasi_kinerja', [IndexController::class, 'evaluasi_kinerja'])->name('evaluasi_kinerja');

require __DIR__ . '/auth.php';
