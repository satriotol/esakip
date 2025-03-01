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
        Schema::create('opd_penilaian_feedbacks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('opd_penilaian_id');
            $table->unsignedBigInteger('user_id');
            $table->longText('feedback');
            $table->timestamps();

            $table->foreign('opd_penilaian_id')->references('id')->on('opd_penilaians')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opd_penilaian_feedback');
    }
};
