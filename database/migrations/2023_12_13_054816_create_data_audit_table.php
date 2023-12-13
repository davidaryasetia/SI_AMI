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
        Schema::create('data_audit', function (Blueprint $table) {
            $table->id();
            $table->string('user_audite');
            $table->string('user_auditor');
            $table->string('capaian');
            $table->string('link_dokumen');
            $table->integer('penilaian');
            $table->text('saran');
            $table->boolean('status_pengisian_audite');
            $table->boolean('status_penilaian_auditor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_audit');
    }
};
