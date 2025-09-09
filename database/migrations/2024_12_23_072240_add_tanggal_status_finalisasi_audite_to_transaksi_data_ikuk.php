<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transaksi_data_ikuk', function (Blueprint $table) {
            $table->timestamp('tanggal_status_finalisasi_audite')->after('status_finalisasi_audite')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_data_ikuk', function (Blueprint $table) {
            $table->dropColumn('tanggal_status_finalisasi_audite');
        });
    }
};
