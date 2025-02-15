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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
            $table->longText('name');
            $table->text('address')->nullable();
            $table->text('phone_01')->nullable();
            $table->text('phone_02')->nullable();
            $table->text('phone_03')->nullable();
            $table->text('responsible_name')->nullable();
            $table->text('image')->nullable();
            $table->integer('cars_limit')->default(5);
            $table->integer('refresh_limit')->default(20);
            $table->integer('fast_location_limit')->default(20);
            $table->text('password')->nullable();
            $table->integer('status')->default(1);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
