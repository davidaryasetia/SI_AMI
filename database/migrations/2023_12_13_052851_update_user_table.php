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
        if(Schema::hasTable('unit')){
            Schema::table('users', function(Blueprint $table){
                $table->unsignedBigInteger('unit_id')->after('id');
                $table->foreign('unit_id')->references('id')->on('unit');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasTable('unit')){
            Schema::table('users', function(Blueprint $table){
                $table->dropForeign(['unit_id']);
               $table->dropColumn('unit_id');
            });
        }
    }
};
