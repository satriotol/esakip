<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opd_penilaians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('opd_id');
            $table->year('year');
            $table->bigInteger('rb_target')->nullable();
            $table->bigInteger('rb_realisasi')->nullable();
            $table->bigInteger('rb_capaian')->nullable();
            $table->bigInteger('rb_penyesuaian_capaian')->nullable();
            $table->bigInteger('rb_nilai_akhir')->nullable();
            $table->bigInteger('sakip_target')->nullable();
            $table->bigInteger('sakip_realisasi')->nullable();
            $table->bigInteger('sakip_capaian')->nullable();
            $table->bigInteger('sakip_penyesuaian_capaian')->nullable();
            $table->bigInteger('sakip_nilai_akhir')->nullable();
            $table->bigInteger('iku_target')->nullable();
            $table->bigInteger('iku_realisasi')->nullable();
            $table->bigInteger('iku_capaian')->nullable();
            $table->bigInteger('iku_penyesuaian_capaian')->nullable();
            $table->bigInteger('iku_nilai_akhir')->nullable();
            $table->bigInteger('penerapan_anggaran_belanja_target')->nullable();
            $table->bigInteger('penerapan_anggaran_belanja_realisasi')->nullable();
            $table->bigInteger('penerapan_anggaran_belanja_capaian')->nullable();
            $table->bigInteger('penerapan_anggaran_belanja_penyesuaian_capaian')->nullable();
            $table->bigInteger('penerapan_anggaran_belanja_nilai_akhir')->nullable();
            $table->bigInteger('realisasi_target_pendapatan_target')->nullable();
            $table->bigInteger('realisasi_target_pendapatan_realisasi')->nullable();
            $table->bigInteger('realisasi_target_pendapatan_capaian')->nullable();
            $table->bigInteger('realisasi_target_pendapatan_penyesuaian_capaian')->nullable();
            $table->bigInteger('realisasi_target_pendapatan_nilai_akhir')->nullable();
            $table->bigInteger('p3dn_target')->nullable();
            $table->bigInteger('p3dn_realisasi')->nullable();
            $table->bigInteger('p3dn_capaian')->nullable();
            $table->bigInteger('p3dn_penyesuaian_capaian')->nullable();
            $table->bigInteger('p3dn_nilai_akhir')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opd_penilaians');
    }
};
