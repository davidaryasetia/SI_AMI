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
        Schema::create('audit_data', function (Blueprint $table) {
            $table->id('audit_data_id');
            $table->string('realisasi');
            $table->string('hasil_audit');
            $table->string('link_data_dukung');
            $table->text('komentar');
            $table->boolean('status_pengisian_audite');
            $table->boolean('status_penilaian_auditor1');
            $table->boolean('status_penilaian_auditor2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_audit');
    }
};
