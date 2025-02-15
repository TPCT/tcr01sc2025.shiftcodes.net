<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Setting;
class Settings extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = new Setting();
        $settings->save();
    }
}
