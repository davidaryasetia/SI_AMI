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
                    ->on('indikator_kinerja_unit_kerja')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('jadwal_ami_id');
            $table->foreign('jadwal_ami_id')
                    ->references('jadwal_ami_id')
                    ->on('jadwal_ami')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('laporan_auditor_id')->nullable();
            $table->foreign('laporan_auditor_id')
                    ->references('laporan_auditor_id')
                    ->on('laporan_auditor')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->string('riwayat_nama_unit')->nullable();
            $table->string('hasil_audit')->nullable();
            $table->boolean('status_pengisian_audite')->nullable();
            $table->boolean('status_verifikasi_auditor')->nullable();
            $table->string('realisasi_ikuk')->nullable();
            $table->longText('analisis')->nullable();
            $table->longText('target_lama')->nullable();
            $table->longText('target_tahun_depan')->nullable();
            $table->longText('strategi_pencapaian')->nullable();
            $table->longText('sarpras_yang_dibutuhkan')->nullable();
            $table->longText('faktor_pendukung')->nullable();
            $table->longText('faktor_penghambat')->nullable();
            $table->longText('akar_masalah')->nullable();
            $table->longText('tindak_lanjut')->nullable();
            $table->longText('status')->nullable();
            $table->string('data_dukung')->nullable();
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
