<?php

use App\Http\Controllers\CascadingKinerjaOpdController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EvaluasiKinerjaController;
use App\Http\Controllers\EvaluasiKinerjaYearController;
use App\Http\Controllers\IkuKotaController;
use App\Http\Controllers\IkuOpdController;
use App\Http\Controllers\InovasiPrestasiDaerahController;
use App\Http\Controllers\KotaPerjanjianKinerjaController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\LkjipKotaController;
use App\Http\Controllers\LkjipOpdController;
use App\Http\Controllers\OpdCategoryController;
use App\Http\Controllers\OpdCategoryVariableController;
use App\Http\Controllers\OpdController;
use App\Http\Controllers\OpdPenilaianController;
use App\Http\Controllers\OpdPenilaianKinerjaController;
use App\Http\Controllers\OpdPenilaianReportController;
use App\Http\Controllers\OpdPerjanjianKinerjaController;
use App\Http\Controllers\OpdPerjanjianKinerjaIndikatorController;
use App\Http\Controllers\OpdPerjanjianKinerjaProgramAnggaranController;
use App\Http\Controllers\OpdPerjanjianKinerjaSasaranController;
use App\Http\Controllers\OpdVariableController;
use App\Http\Controllers\PerencanaanKinerjaCascadingKinerjaController;
use App\Http\Controllers\PerencanaanKinerjaRkpdController;
use App\Http\Controllers\PerencanaanKinerjaRpjmdController;
use App\Http\Controllers\PeriodeRenstraOpdController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RencanaAksiController;
use App\Http\Controllers\RencanaAksiTargetController;
use App\Http\Controllers\RenjaOpdController;
use App\Http\Controllers\RenstraOpdController;
use App\Http\Controllers\RktOpdController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserOpdController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('website', WebsiteController::class);
    Route::resource('user', UserController::class);
    Route::resource('userOpd', UserOpdController::class);
    Route::resource('role', RoleController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('opds', OpdController::class);
    Route::resource('opdCategory', OpdCategoryController::class);
    Route::resource('inovasiPrestasiDaerah', InovasiPrestasiDaerahController::class);
    Route::resource('opdPenilaianKinerja', OpdPenilaianKinerjaController::class);
    Route::get('opdPenilaianKinerja/store/{name}/{opd_penilaian_id}/{opd_category_variable_id}', [OpdPenilaianKinerjaController::class, 'getRealisasiTargetPendapatan'])->name('opdPenilaianKinerja.getRealisasiTargetPendapatan');

    // ===========================
    //perencanaan kinerja
    // kota
    Route::post('perencanaan_kinerja_rpjmd/store_file', [PerencanaanKinerjaRpjmdController::class, 'store_file'])->name('perencanaan_kinerja_rpjmd.store_file');
    Route::resource('perencanaan_kinerja_rpjmd', PerencanaanKinerjaRpjmdController::class);
    Route::post('perencanaan_kinerja_rkpd/store_file', [PerencanaanKinerjaRkpdController::class, 'store_file'])->name('perencanaan_kinerja_rkpd.store_file');
    Route::resource('perencanaan_kinerja_rkpd', PerencanaanKinerjaRkpdController::class);
    Route::post('getRkpds', [PerencanaanKinerjaRkpdController::class, 'getRkpds'])->name('perencanaan_kinerja_rkpd.getRkpds');
    Route::resource('cascading_kinerja', PerencanaanKinerjaCascadingKinerjaController::class);
    Route::post('cascading_kinerja/store_file', [PerencanaanKinerjaCascadingKinerjaController::class, 'store_file'])->name('cascading_kinerja.store_file');
    Route::post('getCascadingKinerjas', [PerencanaanKinerjaCascadingKinerjaController::class, 'getCascadingKinerjas'])->name('cascading_kinerja.getCascadingKinerjas');
    // end of kota
    // ===========================
    // opd
    Route::resource('periodeRenstraOpd', PeriodeRenstraOpdController::class);
    Route::group(['prefix' => 'periodeRenstraOpd/renstraOpd'], function () {
        Route::get('{periodeRenstraOpd}', [RenstraOpdController::class, 'index'])->name('renstraOpd.index');
        Route::get('{periodeRenstraOpd}/create', [RenstraOpdController::class, 'create'])->name('renstraOpd.create');
        Route::post('{periodeRenstraOpd}/store', [RenstraOpdController::class, 'store'])->name('renstraOpd.store');
        Route::get('{periodeRenstraOpd}/edit/{renstraOpd}', [RenstraOpdController::class, 'edit'])->name('renstraOpd.edit');
        Route::put('{periodeRenstraOpd}/update/{renstraOpd}', [RenstraOpdController::class, 'update'])->name('renstraOpd.update');
        Route::delete('delete/{renstraOpd}', [RenstraOpdController::class, 'destroy'])->name('renstraOpd.destroy');
        Route::post('{periodeRenstraOpd}/store_file', [RenstraOpdController::class, 'store_file'])->name('renstraOpd.store_file');
    });

    Route::resource('rktOpd', RktOpdController::class);
    Route::post('getRktOpd', [RktOpdController::class, 'getRktOpd'])->name('rktOpd.getRktOpd');
    Route::post('rktOpd/store_file', [RktOpdController::class, 'store_file'])->name('rktOpd.store_file');

    Route::resource('renjaOpd', RenjaOpdController::class);
    Route::post('getRenjaOpd', [RenjaOpdController::class, 'getRenjaOpd'])->name('renjaOpd.getRenjaOpd');
    Route::post('renjaOpd/store_file', [RenjaOpdController::class, 'store_file'])->name('renjaOpd.store_file');

    Route::resource('cascadingKinerjaOpd', CascadingKinerjaOpdController::class);
    Route::post('getCascadingKinerjaOpd', [CascadingKinerjaOpdController::class, 'getCascadingKinerjaOpd'])->name('cascadingKinerjaOpd.getCascadingKinerjaOpd');
    Route::post('cascadingKinerjaOpd/store_file', [CascadingKinerjaOpdController::class, 'store_file'])->name('cascadingKinerjaOpd.store_file');
    // end of opd
    // end of perencanaan kinerja
    // ===========================
    // ===========================
    // pengukuran kinerja
    // kota
    Route::resource('ikuKota', IkuKotaController::class);
    Route::post('ikuKota/store_file', [IkuKotaController::class, 'store_file'])->name('ikuKotum.store_file');
    Route::resource('kotaPerjanjianKinerja', KotaPerjanjianKinerjaController::class);
    Route::post('getKotaPerjanjianKinerja', [KotaPerjanjianKinerjaController::class, 'getKotaPerjanjianKinerja'])->name('kotaPerjanjianKinerja.getKotaPerjanjianKinerja');
    Route::post('kotaPerjanjianKinerja/store_file', [KotaPerjanjianKinerjaController::class, 'store_file'])->name('kotaPerjanjianKinerja.store_file');
    // end of kota
    // ===========================
    // opd
    Route::resource('ikuOpd', IkuOpdController::class);
    Route::post('getIkuOpd', [IkuOpdController::class, 'getIkuOpd'])->name('ikuOpd.getIkuOpd');
    Route::post('ikuOpd/store_file', [IkuOpdController::class, 'store_file'])->name('ikuOpd.store_file');
    Route::resource('opdPenilaian', OpdPenilaianController::class);
    Route::resource('opdPenilaianReport', OpdPenilaianReportController::class);
    Route::post('opdPenilaian/updateStatus/{opdPenilaian}', [OpdPenilaianController::class, 'updateStatus'])->name('opdPenilaian.updateStatus');
    Route::resource('opdVariable', OpdVariableController::class);
    Route::resource('opdPerjanjianKinerja', OpdPerjanjianKinerjaController::class);
    Route::resource('opdCategoryVariable', OpdCategoryVariableController::class);
    Route::resource('rencanaAksi', RencanaAksiController::class);
    Route::post('rencanaAksi/updateStatus/{rencanaAksi}', [RencanaAksiController::class, 'updateStatus'])->name('rencanaAksi.updateStatus');
    Route::get('rencanaAksi/updateStatusSelesai/{rencanaAksi}', [RencanaAksiController::class, 'updateStatusSelesai'])->name('rencanaAksi.updateStatusSelesai');
    Route::post('rencanaAksi/updateStatusSelesai/store/{rencanaAksi}', [RencanaAksiController::class, 'updateStatusSelesai'])->name('rencanaAksi.updateStatusPenilaian');
    Route::resource('rencanaAksiTarget', RencanaAksiTargetController::class)->except([
        'create'
    ]);
    Route::get('getRencanaAksiTarget/{rencana_aksi_id}', [RencanaAksiTargetController::class, 'getRencanaAksiTarget'])->name('rencanaAksiTarget.getRencanaAksiTarget');
    Route::get('rencanaAksiTarget/create/{rencanaAksi}', [RencanaAksiTargetController::class, 'create'])->name('rencanaAksiTarget.create');
    Route::post('getOpdPerjanjianKinerja', [OpdPerjanjianKinerjaController::class, 'getOpdPerjanjianKinerja'])->name('opdPerjanjianKinerja.getOpdPerjanjianKinerja');
    Route::post('opdPerjanjianKinerja/store_file', [OpdPerjanjianKinerjaController::class, 'store_file'])->name('opdPerjanjianKinerja.store_file');
    Route::put('opdPerjanjianKinerja/updateStatus/{opdPerjanjianKinerja}', [OpdPerjanjianKinerjaController::class, 'updateStatus'])->name('opdPerjanjianKinerja.updateStatus');
    Route::group(['prefix' => 'opdPerjanjianKinerjaSasaran'], function () {
        Route::get('create/{opdPerjanjianKinerja}', [OpdPerjanjianKinerjaSasaranController::class, 'create'])->name('opdPerjanjianKinerjaSasaran.create');
        Route::post('store/{opdPerjanjianKinerja}', [OpdPerjanjianKinerjaSasaranController::class, 'store'])->name('opdPerjanjianKinerjaSasaran.store');
        Route::get('edit/{opdPerjanjianKinerja}/{opdPerjanjianKinerjaSasaran}', [OpdPerjanjianKinerjaSasaranController::class, 'edit'])->name('opdPerjanjianKinerjaSasaran.edit');
        Route::put('update/{opdPerjanjianKinerja}/{opdPerjanjianKinerjaSasaran}', [OpdPerjanjianKinerjaSasaranController::class, 'update'])->name('opdPerjanjianKinerjaSasaran.update');
        Route::delete('destroy/{opdPerjanjianKinerjaSasaran}', [OpdPerjanjianKinerjaSasaranController::class, 'destroy'])->name('opdPerjanjianKinerjaSasaran.destroy');
    });
    Route::group(['prefix' => 'opdPerjanjianKinerjaIndikator'], function () {
        Route::get('create/{opdPerjanjianKinerja}', [OpdPerjanjianKinerjaIndikatorController::class, 'create'])->name('opdPerjanjianKinerjaIndikator.create');
        Route::post('store/{opdPerjanjianKinerja}', [OpdPerjanjianKinerjaIndikatorController::class, 'store'])->name('opdPerjanjianKinerjaIndikator.store');
        Route::get('edit/{opdPerjanjianKinerja}/{opd_perjanjian_kinerja_indikator}', [OpdPerjanjianKinerjaIndikatorController::class, 'edit'])->name('opdPerjanjianKinerjaIndikator.edit');
        Route::put('update/{opdPerjanjianKinerja}/{opd_perjanjian_kinerja_indikator}', [OpdPerjanjianKinerjaIndikatorController::class, 'update'])->name('opdPerjanjianKinerjaIndikator.update');
        Route::delete('destroy/{opdPerjanjianKinerjaIndikator}', [OpdPerjanjianKinerjaIndikatorController::class, 'destroy'])->name('opdPerjanjianKinerjaIndikator.destroy');
    });
    Route::group(['prefix' => 'opdPerjanjianKinerjaProgramAnggaran'], function () {
        Route::get('create/{opdPerjanjianKinerja}', [OpdPerjanjianKinerjaProgramAnggaranController::class, 'create'])->name('opdPerjanjianKinerjaProgramAnggaran.create');
        Route::post('store/{opdPerjanjianKinerja}', [OpdPerjanjianKinerjaProgramAnggaranController::class, 'store'])->name('opdPerjanjianKinerjaProgramAnggaran.store');
        Route::get('edit/{opdPerjanjianKinerja}/{opd_program_anggaran}', [OpdPerjanjianKinerjaProgramAnggaranController::class, 'edit'])->name('opdPerjanjianKinerjaProgramAnggaran.edit');
        Route::put('update/{opdPerjanjianKinerja}/{opd_program_anggaran}', [OpdPerjanjianKinerjaProgramAnggaranController::class, 'update'])->name('opdPerjanjianKinerjaProgramAnggaran.update');
        Route::delete('destroy/{opd_program_anggaran}', [OpdPerjanjianKinerjaProgramAnggaranController::class, 'destroy'])->name('opdPerjanjianKinerjaProgramAnggaran.destroy');
    });
    // end of opd
    // end of pengukuran kinerja
    // ===========================
    // ===========================
    // pelaporan kinerja
    // kota
    Route::resource('lkjip_kota', LkjipKotaController::class);
    Route::post('getLkjipKota', [LkjipKotaController::class, 'getLkjipKota'])->name('lkjip_kota.getLkjipKota');
    Route::post('lkjip_kota/store_file', [LkjipKotaController::class, 'store_file'])->name('lkjip_kotum.store_file');
    // end of kota
    // ===========================
    // opd
    Route::resource('lkjip_opd', LkjipOpdController::class);
    Route::post('getLkjipOpd', [LkjipOpdController::class, 'getLkjipOpd'])->name('lkjip_opd.getLkjipOpd');
    Route::post('lkjip_opd/store_file', [LkjipOpdController::class, 'store_file'])->name('lkjip_opd.store_file');
    // end of opd
    // end of pelaporan kinerja
    // ===========================
    // capaian kinerja
    Route::resource('link', LinkController::class);
    Route::post('link/store_file', [LinkController::class, 'store_file'])->name('link.store_file');
    // end of capaian kinerja
    // ===========================
    // evaluasi kinerja
    Route::resource('evaluasiKinerjaYear', EvaluasiKinerjaYearController::class);
    Route::resource('evaluasiKinerja', EvaluasiKinerjaController::class)->except([
        'create', 'store',
    ]);
    Route::get('evaluasiKinerja/{evaluasiKinerjaYear}/create', [EvaluasiKinerjaController::class, 'create'])->name('evaluasiKinerja.create');
    Route::post('evaluasiKinerja/{evaluasiKinerjaYear}/store', [EvaluasiKinerjaController::class, 'store'])->name('evaluasiKinerja.store');
    // end of evaluasi kinerja

    Route::post('user/resetPassword/{user}', [UserController::class, 'resetPassword'])->name('user.resetPassword');
});
