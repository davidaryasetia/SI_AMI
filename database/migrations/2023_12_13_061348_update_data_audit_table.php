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
        Schema::table('transaksi_indikator_kinerja', function (Blueprint $table) {
            $table->unsignedBigInteger('indikator_kinerja_id')->after('transaksi_indikator_kinerja_id')->nullOnDelete();
            $table->unsignedBigInteger('periode_pengisian_id')->after('indikator_kinerja_id')->nullOnDelete();

            $table->foreign('indikator_kinerja_id')->references('indikator_kinerja_id')->on('indikator_kinerja');
            $table->foreign('periode_pengisian_id')->references('periode_pengisian_id')->on('periode_pengisian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_audit', function (Blueprint $table) {
            $table->dropForeign(['indikator_id']);
            $table->dropForeign(['periode_pengisian_id']);
            $table->dropColumn('indikator_id');
            $table->dropColumn('periode_pengisian_id');
        });
    }
};
