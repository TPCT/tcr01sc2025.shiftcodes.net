<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Currency;

class currencies extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            [
                "name" => "درهم اماراتي",
                "code" => "AED",
                "aed_rate" => 1,
                "default" =>  1,
            ],
            [
                "name" => "ريال سعودي",
                "code" => "SAR",
                "aed_rate" => 2,
                "default" =>  0,
            ],
            [
                "name" => "جنيه مصري",
                "code" => "EGP",
                "aed_rate" => 10,
                "default" =>  0,
            ],
        ];

        foreach($currencies as $c) {
            Currency::create($c);
        }
    }
}
