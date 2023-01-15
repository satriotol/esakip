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
        Schema::table('opd_penilaian_ikus', function (Blueprint $table) {
            $table->string('file')->nullable();
            $table->unsignedBigInteger('is_verified')->nullable();
            $table->longText('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('opd_penilaian_ikus', function (Blueprint $table) {
            $table->dropColumn('file');
            $table->dropColumn('is_verified');
            $table->dropColumn('note');
        });
    }
};
