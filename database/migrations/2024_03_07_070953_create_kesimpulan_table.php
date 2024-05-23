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
        Schema::create('kesimpulan', function (Blueprint $table) {
            $table->id('no_kesimpulan');
            $table->string('indikator_kinerja');
            $table->integer('jumlah_indikator');
            $table->longText('peluang_peningkatan');

            $table->unsignedBigInteger('laporan_auditor_id');
            $table->foreign('laporan_auditor_id')
                    ->references('laporan_auditor_id')
                    ->on('laporan_auditor');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kesimpulan');
    }
};
