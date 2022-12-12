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
        Schema::create('inovasi_prestasi_opds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('opd_id');
            $table->date('date');
            $table->year('year');
            $table->unsignedBigInteger('inovasi_prestasi_tingkat_id');
            $table->string('name');
            $table->longText('instansi_pemberi')->nullable();
            $table->longText('description')->nullable();
            $table->string('file')->nullable();
            $table->unsignedBigInteger('is_verified')->nullable();
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
        Schema::dropIfExists('inovasi_prestasi_opds');
    }
};
