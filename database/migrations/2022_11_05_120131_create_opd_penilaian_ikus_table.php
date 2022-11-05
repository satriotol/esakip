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
        Schema::create('opd_penilaian_ikus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('opd_penilaian_kinerja_id');
            $table->unsignedBigInteger('opd_perjanjian_kinerja_indikator_id');
            $table->string('type');
            $table->text('capaian');
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
        Schema::dropIfExists('opd_penilaian_ikus');
    }
};
