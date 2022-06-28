<?php

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

Route::prefix('admin')->group(__DIR__ . '/adminRoutes.php');
Route::get('/', [IndexController::class, 'home'])->name('home');
Route::get('/pelaporan_kinerja', [IndexController::class, 'pelaporan_kinerja'])->name('pelaporan_kinerja');
Route::get('/perencanaan_kinerja_kota', [IndexController::class, 'perencanaan_kinerja_kota'])->name('perencanaan_kinerja_kota');

require __DIR__ . '/auth.php';
