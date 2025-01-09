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
        Schema::table('indikator_kinerja_unit_kerja', function (Blueprint $table) {
            $table->integer('target1')->nullable()->after('target_ikuk');
            $table->integer('target2')->nullable()->after('target1');
            $table->string('link')->nullable()->after('target2');
            $table->integer('tipe')->default(0)->after('link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('indikator_kinerja_unit_kerja', function (Blueprint $table) {
            $table->dropColumn(['target1', 'target2', 'link', 'tipe']);
        });
    }
};
