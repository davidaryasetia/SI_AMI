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
        Schema::create('transaksi_data_iksk', function (Blueprint $table) {
            $table->id('transaksi_data_iksk_id');

            $table->unsignedBigInteger('indikator_kinerja_sub_kegiatan_id');
            $table->foreign('indikator_kinerja_sub_kegiatan_id', 'fk_transaksi_iksk')
                    ->references('indikator_kinerja_sub_kegiatan_id')
                    ->on('indikator_kinerja_sub_kegiatan');

            $table->unsignedBigInteger('jadwal_ami_id')
                    ->references('jadwal_ami_id')
                    ->on('jadwal_ami');
                    
            $table->string('hasil_audit');
            $table->string('realisasi_iksk');
            $table->string('data_dukung');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_data_iksk');
    }
};
