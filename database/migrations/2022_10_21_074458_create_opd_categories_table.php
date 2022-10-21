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
        Schema::create('opd_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('reformasi_birokrasi');
            $table->bigInteger('sakip');
            $table->bigInteger('iku');
            $table->bigInteger('penyerapan_anggaran_belanja');
            $table->bigInteger('realisasi_target_pendapatan');
            $table->bigInteger('p3dn');
            $table->bigInteger('inovasi_prestasi_daerah');
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
        Schema::dropIfExists('opd_categories');
    }
};
