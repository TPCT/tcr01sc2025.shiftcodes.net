<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeleteCarsWithNoCompany extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = \App\Models\Car::where('company_id', null)
        ->orWhere('company_id', "")
        ->get();
        foreach ($cars as $car) {
            $car->delete();
        }
    }
}
