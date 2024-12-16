<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('indikator_kinerja_unit_kerja', function (Blueprint $table) {
            $table->unsignedBigInteger('jadwal_ami_id')->after('indikator_kinerja_unit_kerja_id')->nullable();
            $table->foreign('jadwal_ami_id')
                ->references('jadwal_ami_id')
                ->on('jadwal_ami')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('indikator_kinerja_unit_kerja', function (Blueprint $table) {
            $table->dropColumn('jadwal_ami_id');
        });
    }
};
