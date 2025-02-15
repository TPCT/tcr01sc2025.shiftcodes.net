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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();

            $table->longText('name')->nullable();
            $table->float('price_per_day')->nullable()->default(0);
            $table->float('price_per_week')->nullable()->default(0);
            $table->float('price_per_month')->nullable()->default(0);
            $table->integer('minimum_day_booking')->nullable()->default(1);
            $table->integer('is_day_offer')->nullable()->default(0);
            $table->float('day_offer_price')->nullable();
            $table->float('security_deposit')->nullable();
            $table->longText('customer_notes')->nullable();
            $table->foreignId('color_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->foreignId('model_id')->constrained()->onDelete('cascade');
            $table->foreignId('year_id')->constrained()->onDelete('cascade');
            $table->text('image')->nullable();
            $table->string('engine_capacity')->nullable();
            $table->string('doors')->nullable();
            $table->string('passengers')->nullable();
            $table->string('bags')->nullable();

            $table->enum('status',['pending','active'])->index()->default('pending');

            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
