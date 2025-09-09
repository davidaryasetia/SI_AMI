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
            $table->text('saran_auditor1')->nullable()->after('data_dukung');
            $table->text('saran_auditor2')->nullable()->after('saran_auditor1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_data_ikuk', function (Blueprint $table) {
            $table->dropColumn(['saran_auditor1', 'saran_auditor2']);
        });
    }
};
