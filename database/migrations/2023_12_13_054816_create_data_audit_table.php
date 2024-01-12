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
        Schema::create('transaksi_indikator_kinerja', function (Blueprint $table) {
            $table->id('transaksi_indikator_kinerja_id');
            $table->string('capaian_realisasi');
            $table->enum('hasil_audit', ['melampaui','memenuhi','belum memenuhi']);
            $table->string('upload_data_dukung');
            $table->text('saran_audit');
            $table->text('capaian_kinerja_selanjutnya');
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
