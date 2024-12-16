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
        Schema::create('unit_cabang', function (Blueprint $table) {
            $table->id('unit_cabang_id');
            $table->unsignedBigInteger('unit_id')->nullOnDelete();
            $table->foreign('unit_id')
                    ->references('unit_id')
                    ->on('unit')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            
            $table->string('nama_unit_cabang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_branch');
    }
};
