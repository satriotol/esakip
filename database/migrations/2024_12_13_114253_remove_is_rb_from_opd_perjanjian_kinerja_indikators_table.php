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
        Schema::table('opd_perjanjian_kinerja_indikators', function (Blueprint $table) {
            $table->dropColumn('is_rb');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('opd_perjanjian_kinerja_indikators', function (Blueprint $table) {
            $table->unsignedBigInteger('is_rb')->nullable();
        });
    }
};
