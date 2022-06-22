<?php

use App\Http\Controllers\PerencanaanKinerjaCategoryController;
use App\Http\Controllers\PerencanaanKinerjaController;
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
    Route::resource('perencanaan_kinerja', PerencanaanKinerjaController::class);

    // perencanaan kinerja category
    Route::get('perencanaan_kinerja_category/create/{perencanaan_kinerja}', [PerencanaanKinerjaCategoryController::class, 'create'])->name('perencanaan_kinerja_category.create');
    Route::post('perencanaan_kinerja_category/store', [PerencanaanKinerjaCategoryController::class, 'store'])->name('perencanaan_kinerja_category.store');
    // end of perencanaan kinerja category

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
