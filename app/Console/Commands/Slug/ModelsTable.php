<?php

namespace App\Console\Commands\Slug;

use App\Helpers\Utilities;
use App\Models\Company;
use App\Models\Models;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class ModelsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:slug-models';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (Models::all() as $model) {
            $this->info("Updating {$model->title}");
            $model->update([
                'slug' => Utilities::slug($model->title)
            ]);
            $this->info("{$model->title} Slug = {$model->slug}");
        }
    }
}
