<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Company;
class AddPreviousRefreshToCompanies extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::with('cars')->get();
        foreach ($companies as $company) {
            foreach ($company->cars as $car) {
                if($car->is_refresh && $car->refreshed_at) {
                    $company->refreshes()->create([
                        'car_id' => $car->id
                    ]);
                }
            }
        }
    }
}
