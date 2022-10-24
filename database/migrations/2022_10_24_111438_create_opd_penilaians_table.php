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
            $table->unsignedBigInteger('opd_category_id');
            $table->year('year');
            $table->string('name')->nullable();
            $table->bigInteger('inovasi_prestasi_daerah')->nullable();
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
