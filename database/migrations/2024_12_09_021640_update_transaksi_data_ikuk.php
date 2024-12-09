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
        Schema::table('transaksi_data_ikuk', function (Blueprint $table) {
            $table->boolean('status_pengisian_audite')->default(false)->after('data_dukung');
            $table->boolean('status_pengisian_auditor')->default(false)->after('status_pengisian_audite');
            $table->boolean('status_finalisasi_audite')->default(false)->after('status_pengisian_auditor');
            $table->boolean('status_finalisasi_auditor1')->default(false)->after('status_finalisasi_audite');
            $table->boolean('status_finalisasi_auditor2')->default(false)->after('status_finalisasi_auditor1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_data_ikuk', function (Blueprint $table) {
            $table->dropColumn('status_pengisian_audite');
            $table->dropColumn('status_pengisian_auditor');
            $table->dropColumn('status_finalisasi_audite');
            $table->dropColumn('status_finalisasi_auditor1');
            $table->dropColumn('status_finalisasi_auditor2');
        });
    }
};
