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
        Schema::table('settings', function (Blueprint $table) {
            $table->longText("car_types_title")->nullable();
            $table->longText("car_types_description")->nullable();
            $table->longText("car_brands_title")->nullable();
            $table->longText("car_brands_description")->nullable();
            $table->longText("car_companies_title")->nullable();
            $table->longText("car_companies_description")->nullable();
            $table->longText("book_your_next_trip_left")->nullable();
            $table->longText("book_your_next_trip_right")->nullable();
            $table->longText("find_your_car_title")->nullable();
            $table->longText("find_your_car_description")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
};
