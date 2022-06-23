<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LkjipKotaController;
use App\Http\Controllers\LkjipOpdController;
use App\Http\Controllers\PerencanaanKinerjaCascadingKinerjaController;
use App\Http\Controllers\PerencanaanKinerjaRkpdController;
use App\Http\Controllers\PerencanaanKinerjaRpjmdController;
use App\Http\Controllers\PeriodeRenstraOpdController;
use App\Http\Controllers\RenstraOpdController;
use App\Http\Controllers\RktOpdController;
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
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    //perencanaan kinerja
    // kota
    Route::resource('perencanaan_kinerja_rpjmd', PerencanaanKinerjaRpjmdController::class);

    Route::resource('perencanaan_kinerja_rkpd', PerencanaanKinerjaRkpdController::class);
    Route::post('getRkpds', [PerencanaanKinerjaRkpdController::class, 'getRkpds'])->name('perencanaan_kinerja_rkpd.getRkpds');

    Route::resource('cascading_kinerja', PerencanaanKinerjaCascadingKinerjaController::class);
    Route::post('getCascadingKinerjas', [PerencanaanKinerjaCascadingKinerjaController::class, 'getCascadingKinerjas'])->name('cascading_kinerja.getCascadingKinerjas');
    // end of kota
    // opd
    Route::resource('periodeRenstraOpd', PeriodeRenstraOpdController::class);
    Route::group(['prefix' => 'periodeRenstraOpd/renstraOpd'], function () {
        Route::get('{periodeRenstraOpd}', [RenstraOpdController::class, 'index'])->name('renstraOpd.index');
        Route::get('{periodeRenstraOpd}/create', [RenstraOpdController::class, 'create'])->name('renstraOpd.create');
        Route::post('{periodeRenstraOpd}/store', [RenstraOpdController::class, 'store'])->name('renstraOpd.store');
        Route::get('{periodeRenstraOpd}/edit/{renstraOpd}', [RenstraOpdController::class, 'edit'])->name('renstraOpd.edit');
        Route::put('{periodeRenstraOpd}/update/{renstraOpd}', [RenstraOpdController::class, 'update'])->name('renstraOpd.update');
        Route::delete('delete/{renstraOpd}', [RenstraOpdController::class, 'destroy'])->name('renstraOpd.destroy');
    });

    Route::resource('rktOpd', RktOpdController::class);
    Route::post('getRktOpd', [RktOpdController::class, 'getRktOpd'])->name('rktOpd.getRktOpd');
    // end of opd
    // end of perencanaan kinerja

    // pelaporan kinerja
    // kota
    Route::resource('lkjip_kota', LkjipKotaController::class);
    Route::post('getLkjipKota', [LkjipKotaController::class, 'getLkjipKota'])->name('lkjip_kota.getLkjipKota');
    // end of kota
    // opd
    Route::resource('lkjip_opd', LkjipOpdController::class);
    Route::post('getLkjipOpd', [LkjipOpdController::class, 'getLkjipOpd'])->name('lkjip_opd.getLkjipOpd');
    // end of opd
    // end of pelaporan kinerja

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
