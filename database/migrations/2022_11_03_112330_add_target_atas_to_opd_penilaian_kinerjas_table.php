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
        Schema::table('opd_penilaian_kinerjas', function (Blueprint $table) {
            $table->bigInteger('target_atas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('opd_penilaian_kinerjas', function (Blueprint $table) {
            $table->dropColumn('target_atas');
        });
    }
};
