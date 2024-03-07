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
        Schema::create('waktu_pelaksanaan', function (Blueprint $table) {
            $table->id('pelaksanaan_id');
            $table->year('tahun');
            $table->integer('semester')->lenght(2);
            $table->dateTime('tanggal_pembukaan_ami');
            $table->dateTime('tanggal_penutupan_ami');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waktu_pelaksanaan');
    }
};
