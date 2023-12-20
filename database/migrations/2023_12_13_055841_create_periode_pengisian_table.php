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
        Schema::create('periode_pengisian', function (Blueprint $table) {
            $table->id('periode_pengisian_id');
            $table->year('tahun');
            $table->integer('periode')->lenght(2);
            $table->dateTime('tanggal_isi_audite');
            $table->dateTime('tanggal_tutup_audite');
            $table->dateTime('tanggal_isi_auditor');
            $table->dateTime('tanggal_tutup_auditor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periode_pengisian');
    }
};
