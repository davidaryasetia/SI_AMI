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
            $table->unsignedBigInteger('indikator_kinerja_kegiatan_id');
            $table->foreign('indikator_kinerja_kegiatan_id', 'fk_ikk_id')
                    ->references('indikator_kinerja_kegiatan_id')
                    ->on('indikator_kinerja_kegiatan');

         
            $table->longText('isi_indikator_kinerja_sub_kegiatan');
            $table->string('kode_iksk');
            $table->string('satuan_iksk');
            $table->integer('target_iksk')->nullable();
            $table->timestamps();
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
