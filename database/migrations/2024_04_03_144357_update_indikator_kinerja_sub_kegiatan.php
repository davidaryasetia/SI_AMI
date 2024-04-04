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
        Schema::table('indikator_kinerja_sub_kegiatan', function (Blueprint $table) {
           $table-> unsignedBigInteger('indikator_kinerja_kegiatan_id')->after('indikator_kinerja_sub_kegiatan_id');
           $table->foreign('indikator_kinerja_kegiatan_id', 'fk_ikk_id')
                    ->references('indikator_kinerja_kegiatan_id')
                    ->on('indikator_kinerja_kegiatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('indikator_kinerja_sub_kegiatan', function (Blueprint $table) {
            $table->dropIfExists('indikator_kinerja_kegiatan_id');
        });
    }
};
