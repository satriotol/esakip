<?php

use App\Http\Controllers\PerencanaanKinerjaIkuController;
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
    Route::resource('rpjmd', RpmjdController::class);
    Route::resource('PerencanaanKinerjaIku', PerencanaanKinerjaIkuController::class);

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
