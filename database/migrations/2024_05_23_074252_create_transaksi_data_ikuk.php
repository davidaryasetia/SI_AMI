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
        Schema::create('transaksi_data_ikuk', function (Blueprint $table) {
            $table->id('transaksi_data_ikuk_id');

            $table->unsignedBigInteger('indikator_kinerja_unit_kerja_id');
            $table->foreign('indikator_kinerja_unit_kerja_id', 'fk_transaksi_ikuk')
                    ->references('indikator_kinerja_unit_kerja_id')
                    ->on('indikator_kinerja_unit_kerja');

            $table->unsignedBigInteger('jadwal_ami_id');
            $table->foreign('jadwal_ami_id')
                    ->references('jadwal_ami_id')
                    ->on('jadwal_ami');

            $table->unsignedBigInteger('laporan_auditor_id');
            $table->foreign('laporan_auditor_id')
                    ->references('laporan_auditor_id')
                    ->on('laporan_auditor');

            $table->string('riwayat_nama_unit');
            $table->string('hasil_audit');
            $table->boolean('status_pengisian_audite');
            $table->boolean('status_verifikasi_auditor');
            $table->string('realisasi_ikuk');
            $table->longText('analisis');
            $table->longText('target_lama');
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
        Schema::dropIfExists('transaksi_data_ikuk');
    }
};
