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
        Schema::table('rencana_aksi_targets', function (Blueprint $table) {
            $table->longText('indikator_kinerja_note')->nullable();
            $table->longText('satuan')->nullable();
            $table->string('type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rencana_aksi_targets', function (Blueprint $table) {
            $table->dropColumn('indikator_kinerja_note');
            $table->dropColumn('satuan');
            $table->dropColumn('type');
        });
    }
};
