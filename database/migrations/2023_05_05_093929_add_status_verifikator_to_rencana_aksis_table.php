<?php

use App\Models\RencanaAksi;
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
            $table->string('status_verifikator')->nullable();
        });
        RencanaAksi::whereNull('status_verifikator')->update(['status_verifikator' => 'SELESAI']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rencana_aksis', function (Blueprint $table) {
            $table->dropColumn('status_verifikator');
        });
    }
};
