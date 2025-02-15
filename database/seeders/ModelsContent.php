<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModelsContent extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = \App\Models\Models::all();
        foreach($models as $model) {
            $content = new \Modules\Admin\App\Services\ContentService();
            $content->createEmpty('model', $model->id);
        }
    }
}
