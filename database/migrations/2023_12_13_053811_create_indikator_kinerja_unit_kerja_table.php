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
        Schema::create('indikator_kinerja_unit_kerja', function (Blueprint $table) {
            $table->id('indikator_kinerja_unit_kerja_id');
            $table->string('kode')->unique();
            $table->string('isi_indikator_kinerja_unit_kerja'); 
            $table->string('satuan_ikuk');
            $table->integer('target_ikuk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indikator_kinerja_unit_kerja');
    }
};
