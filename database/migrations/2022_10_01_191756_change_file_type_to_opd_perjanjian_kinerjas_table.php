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
        Schema::table('opd_perjanjian_kinerjas', function (Blueprint $table) {
            $table->string('file')->nullable()->change();
            $table->string('status')->nullable();
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
        Schema::table('opd_perjanjian_kinerjas', function (Blueprint $table) {
            $table->string('file')->change();
            $table->dropColumn('status');
            $table->dropColumn('note');
        });
    }
};
