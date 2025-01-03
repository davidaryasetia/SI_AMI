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
        Schema::create('jadwal_ami', function (Blueprint $table) {
            $table->id('jadwal_ami_id');
            $table->string('nama_periode_ami');
            $table->date('tanggal_pembukaan_ami');
            $table->date('tanggal_penutupan_ami');
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
