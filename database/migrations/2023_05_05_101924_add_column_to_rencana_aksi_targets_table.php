<?php

use App\Models\RencanaAksiTarget;
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
            $table->string('status_verifikator')->nullable();
            $table->longText('note_verifikator')->nullable();
        });
        RencanaAksiTarget::whereNull('status_verifikator')->update([
            'status_verifikator' => 'DITERIMA'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rencana_aksi_targets', function (Blueprint $table) {
            $table->dropColumn('status_verifikator');
            $table->dropColumn('note_verifikator');
        });
    }
};
