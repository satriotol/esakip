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
        Schema::create('opd_penilaian_staff', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('opd_penilaian_id');
            $table->unsignedBigInteger('opd_penilaian_staff_type_id');
            $table->unsignedBigInteger('month_id');
            $table->string('judul')->nullable();
            $table->longText('description')->nullable();
            $table->string('file');
            $table->string('status')->nullable();
            $table->string('kualitas')->default(0);
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
        Schema::dropIfExists('opd_penilaian_staff');
    }
};
