<?php

use App\Http\Controllers\PerencanaanKinerjaCascadingKinerjaController;
use App\Http\Controllers\PerencanaanKinerjaIkuController;
use App\Http\Controllers\PerencanaanKinerjaRkpdController;
use App\Http\Controllers\PerencanaanKinerjaRpjmdController;
use App\Http\Controllers\RpmjdController;
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

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('pages.forms.advanced-elements');
    });
    
    //perencanaan kinerja
    // kota
    Route::resource('perencanaan_kinerja_rpjmd', PerencanaanKinerjaRpjmdController::class);

    Route::resource('perencanaan_kinerja_rkpd', PerencanaanKinerjaRkpdController::class);
    Route::post('getRkpds', [PerencanaanKinerjaRkpdController::class, 'getRkpds'])->name('perencanaan_kinerja_rkpd.getRkpds');

    Route::resource('cascading_kinerja', PerencanaanKinerjaCascadingKinerjaController::class);
    Route::post('getCascadingKinerjas', [PerencanaanKinerjaCascadingKinerjaController::class, 'getCascadingKinerjas'])->name('cascading_kinerja.getCascadingKinerjas');
    // end of kota
    // end of perencanaan kinerja

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
