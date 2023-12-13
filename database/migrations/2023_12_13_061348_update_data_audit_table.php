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
        Schema::table('data_audit', function (Blueprint $table) {
            $table->unsignedBigInteger('indikator_id')->after('id');
            $table->unsignedBigInteger('periode_pengisian_id')->after('indikator_id');

            $table->foreign('indikator_id')->references('id')->on('indikator');
            $table->foreign('periode_pengisian_id')->references('id')->on('periode_pengisian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_audit', function (Blueprint $table) {
            $table->dropForeign(['indikator_id']);
            $table->dropForeign(['periode_pengisian_id']);
            $table->dropColumn('indikator_id');
            $table->dropColumn('periode_pengisian_id');
        });
    }
};
