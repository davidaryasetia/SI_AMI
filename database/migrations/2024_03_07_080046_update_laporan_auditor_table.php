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
        Schema::table('laporan_auditor', function (Blueprint $table) {
            $table->unsignedBigInteger('no_tujuan');
            $table->foreign('no_tujuan')->references('no_tujuan')->on('tujuan_audit');

            $table->unsignedBigInteger('no_lingkup');
            $table->foreign('no_lingkup')->references('no_lingkup')->on('lingkup_audit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_auditor', function (Blueprint $table) {
            //
        });
    }
};
