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
        Schema::create('auditor', function (Blueprint $table) {
            $table->id('auditor_id');

            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')
                    ->references('unit_id')
                    ->on('unit')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('auditor_1')->nullable();
            $table->foreign('auditor_1')
                    ->references('user_id')
                    ->on('user')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            
            $table->unsignedBigInteger('auditor_2')->nullable();
            $table->foreign('auditor_2')
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
        Schema::dropIfExists('auditor');
    }
};
 