<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('indikator_kinerja_kegiatan', function (Blueprint $table) {
            $table->id('indikator_kinerja_kegiatan_id');
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('unit_id')->on('unit');
            $table->string('kode_ikk');
            $table->string('isi_indikator_kinerja_kegiatan');
            $table->string('satuan_ikk');
            $table->integer('target_ikk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('indikator_kinerja_kegiatan', function (Blueprint $table) {
            //
        });
    }
};
