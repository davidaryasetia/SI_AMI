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
        Schema::create('audite', function (Blueprint $table) {
            $table->id('audite_id');

            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')
                    ->references('unit_id')
                    ->on('unit')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('unit_cabang_id')->nullable(true);
            $table->foreign('unit_cabang_id')
                    ->references('unit_cabang_id')
                    ->on('unit_cabang')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->nullable(true);
            $table->foreign('user_id')
                    ->references('user_id')
                    ->on('user')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audite');
    }
};
