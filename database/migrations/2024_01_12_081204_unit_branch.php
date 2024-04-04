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
        Schema::create('unit_branch', function (Blueprint $table) {
            $table->id('unit_branch_id');
            $table->unsignedBigInteger('unit_id')->nullOnDelete();
            $table->foreign('unit_id')->references('unit_id')->on('unit');
            $table->string('nama_unit_branch')->lenght(64)->unique();
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
