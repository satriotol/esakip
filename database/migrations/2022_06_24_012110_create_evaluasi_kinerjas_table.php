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
        Schema::create('evaluasi_kinerjas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluasi_kinerja_year_id');
            $table->unsignedBigInteger('opd_id');
            $table->double('value')->nullable()->default(0);
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
        Schema::dropIfExists('evaluasi_kinerjas');
    }
};
