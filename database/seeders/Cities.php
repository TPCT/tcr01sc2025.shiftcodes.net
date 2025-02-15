<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Cities extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $cities = \App\Models\City::all();
       foreach($cities as $city) {
            $content = new \Modules\Admin\App\Services\ContentService();
            $content->createEmpty("city", $city->id);
       }
    }
}
