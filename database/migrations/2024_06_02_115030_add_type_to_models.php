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
        Schema::table('models', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);

            // Change the column to be nullable
            $table->bigInteger('brand_id')->unsigned()->nullable()->change();

            // Add the foreign key constraint back
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->enum('type', ['car', 'yacht'])->default('car');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('models', function (Blueprint $table) {
            //
        });
    }
};
