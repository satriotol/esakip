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
        Schema::create('opd_perjanjian_kinerja_sasarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('opd_perjanjian_kinerja_id');
            $table->longText('sasaran');
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
        Schema::dropIfExists('opd_perjanjian_kinerja_sasarans');
    }
};
