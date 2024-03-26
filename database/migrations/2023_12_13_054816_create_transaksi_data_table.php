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
        Schema::create('transaksi_data', function (Blueprint $table) {
            $table->id('transaksi_data_id');  
            $table->string('riwayat_nama_unit');
            $table->boolean('status_pengisian_audite');
            $table->boolean('status_verifikasi_auditor');
            $table->string('realisasi');
            $table->enum('hasil_audit', ['melampaui','memenuhi','belum memenuhi']);
            $table->longText('analisis');
            $table->longText('target_tahun_depan');
            $table->longText('strategi_pencapaian');
            $table->longText('sarpras_yang_dibutuhkan');
            $table->longText('faktor_pendukung');
            $table->longText('faktor_penghambat');
            $table->longText('akar_masalah');
            $table->longText('tindak_lanjut');
            $table->longText('status');
            $table->string('data_dukung');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_data');
    }
};
