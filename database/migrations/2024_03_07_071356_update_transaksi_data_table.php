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
        Schema::table('transaksi_data', function (Blueprint $table) {
            $table->unsignedBigInteger('pelaksanaan_id');
            $table->foreign('pelaksanaan_id')->references('pelaksanaan_id')->on('waktu_pelaksanaan');
            
            $table->unsignedBigInteger('laporan_auditor_id');
            $table->foreign('laporan_auditor_id')->references('laporan_auditor_id')->on('laporan_auditor');

            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('unit_id')->on('unit');

            $table->unsignedBigInteger('auditor_id');
            $table->foreign('auditor_id')->references('auditor_id')->on('auditor');
            
            $table->unsignedBigInteger('indikator_kinerja_id');
            $table->foreign('indikator_kinerja_id')->references('indikator_kinerja_id')->on('indikator_kinerja_unit');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_data', function (Blueprint $table) {
            //
        });
    }
};
