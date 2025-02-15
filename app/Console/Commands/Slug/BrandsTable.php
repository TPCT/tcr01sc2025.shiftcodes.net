<?php

namespace App\Console\Commands\Slug;

use App\Helpers\Utilities;
use App\Models\Brand;
use App\Models\Currency;
use Illuminate\Console\Command;

class BrandsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:slug-brands';

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
        foreach (Brand::all() as $brand) {
            $this->info("Updating {$brand->title}");
            $brand->update([
                'slug' => Utilities::slug($brand->title)
            ]);
            $this->info("{$brand->title} Slug = {$brand->slug}");
        }
    }
}
