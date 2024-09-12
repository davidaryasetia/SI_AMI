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
        Schema::create('saran', function (Blueprint $table) {
            $table->id('no_saran');
            $table->string('indikator_kinerja');

            $table->unsignedBigInteger('laporan_auditor_id');
            $table->foreign('laporan_auditor_id')
                    ->references('laporan_auditor_id')
                    ->on('laporan_auditor');
                    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saran');
    }
};
