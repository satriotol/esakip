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
        Schema::table('rencana_aksis', function (Blueprint $table) {
            $table->string('status_penilaian')->nullable();
            $table->string('nilai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rencana_aksis', function (Blueprint $table) {
            $table->dropColumn('status_penilaian');
            $table->dropColumn('nilai');
        });
    }
};
