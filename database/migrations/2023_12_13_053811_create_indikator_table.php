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
        Schema::create('indikator_kinerja', function (Blueprint $table) {
            $table->id('indikator_kinerja_id');
            $table->unsignedBigInteger('unit_id')->nullOnDelete();
            $table->foreign('unit_id')->references('unit_id')->on('unit');
            $table->string('kode')->unique();
            $table->string('indikator_kinerja_unit_kerja')->unique();
            $table->string('satuan');
            $table->integer('target');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indikator');
    }
};
