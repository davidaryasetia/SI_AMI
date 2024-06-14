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
            
            $table->unsignedBigInteger('indikator_kinerja_sub_kegiatan_id');
            $table->foreign('indikator_kinerja_sub_kegiatan_id', 'fk_iksk_id')
                    ->references('indikator_kinerja_sub_kegiatan_id')
                    ->on('indikator_kinerja_sub_kegiatan');

            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')
                    ->references('unit_id')
                    ->on('unit');

            $table->string('kode_ikuk')->unique();
            $table->longText('isi_indikator_kinerja_unit_kerja'); 
            $table->string('satuan_ikuk');
            $table->integer('target_ikuk')->nullable();
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
