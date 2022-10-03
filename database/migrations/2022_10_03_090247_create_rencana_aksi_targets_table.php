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
        Schema::create('rencana_aksi_targets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('opd_perjanjian_kinerja_sasaran_id');
            $table->unsignedBigInteger('rencana_aksi_id');
            $table->longText('target');
            $table->string('realisasi');
            $table->string('status')->nullable();
            $table->longText('note')->nullable();
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
        Schema::dropIfExists('rencana_aksi_targets');
    }
};
