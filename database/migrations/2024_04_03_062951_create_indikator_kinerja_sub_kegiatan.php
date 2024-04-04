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
        Schema::create('indikator_kinerja_sub_kegiatan', function (Blueprint $table) {
            $table->id('indikator_kinerja_sub_kegiatan_id');
            $table->text('isi_indikator_kinerja_sub_kegiatan');
            $table->string('satuan_iksk');
            $table->string('target_iksk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indikator_kinerja_sub_kegiata');
    }
};
