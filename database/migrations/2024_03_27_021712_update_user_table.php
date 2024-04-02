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
            Schema::table('user', function(Blueprint $table){
                $table->unsignedBigInteger('unit_id')->after('user_id')->nullOnDelete()->nullable();
                $table->foreign('unit_id')->references('unit_id')->on('unit');

                $table->unsignedBigInteger('unit_branch_id')->after('unit_id')->nullable() ;
                $table->foreign('unit_branch_id')->references('unit_branch_id')->on('unit_branch');
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
