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
        Schema::table('companies', function (Blueprint $table) {
            $table->integer('delivery_time')->default(24)->nullable();
            $table->double('salik_fees')->default(0)->nullable();
            $table->double('vat_percentage')->default(5)->nullable();
            $table->integer('min_age')->default(21)->nullable();
            $table->integer('deposit_refund')->default(0)->nullable();
            $table->longText("terms")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            //
        });
    }
};
