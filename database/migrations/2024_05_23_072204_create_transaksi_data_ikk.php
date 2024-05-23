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
        Schema::create('transaksi_data_ikk', function (Blueprint $table) {
            $table->id('transaksi_data_ikk_id');

            $table->unsignedBigInteger('indikator_kinerja_kegiatan_id');
            $table->foreign('indikator_kinerja_kegiatan_id', 'fk_transaksi_ikk')
                    ->references('indikator_kinerja_kegiatan_id')
                    ->on('indikator_kinerja_kegiatan');

            $table->unsignedBigInteger('auditor_id');
            $table->foreign('auditor_id')
                    ->references('auditor_id')
                    ->on('auditor');

            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')
                    ->references('unit_id')
                    ->on('unit');

            $table->unsignedBigInteger('jadwal_ami_id');
            $table->foreign('jadwal_ami_id')
                    ->references('jadwal_ami_id')
                    ->on('jadwal_ami');

            $table->string('hasil_audit');
            $table->string('realisasi_ikk');
            $table->string('data_dukung');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_data_ikk');
    }
};
