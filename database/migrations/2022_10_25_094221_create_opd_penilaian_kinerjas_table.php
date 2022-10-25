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
        Schema::create('opd_penilaian_kinerjas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('opd_penilian_id');
            $table->unsignedBigInteger('opd_category_variable_id');
            $table->bigInteger('target')->nullable();
            $table->bigInteger('realisasi')->nullable();
            $table->bigInteger('capaian')->nullable();
            $table->bigInteger('nilai_akhir')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('opd_penilaian_kinerjas');
    }
};
