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
        Schema::create('perencanaan_kinerja_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perencanaan_kinerja_id');
            $table->string('name');
            $table->string('title');
            $table->string('type');
            $table->boolean('show');
            $table->boolean('download');
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
        Schema::dropIfExists('perencanaan_kinerja_categories');
    }
};
