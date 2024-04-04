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
        Schema::table('indikator_kinerja_unit_kerja', function (Blueprint $table) {
            $table->unsignedBigInteger('indikator_kinerja_sub_kegiatan_id')
                    ->after('indikator_kinerja_unit_kerja_id');
                    
            $table->foreign('indikator_kinerja_sub_kegiatan_id', 'fk_iksk')
                    ->references('indikator_kinerja_sub_kegiatan_id')
                    ->on('indikator_kinerja_sub_kegiatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('indikator_kinerja_unit_kerja', function (Blueprint $table) {
            Schema::dropIfExists('indikator_kinerja_unit_kerja');
        });
    }
};
