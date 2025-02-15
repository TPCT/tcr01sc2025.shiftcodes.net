<?php

namespace App\Console\Commands\Slug;

use App\Helpers\Utilities;
use App\Models\Blog;
use App\Models\Car;
use Illuminate\Console\Command;

class CarsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:slug-cars';

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
        foreach (Car::all() as $car) {
            $this->info("Updating {$car->name}");
            $car->update([
                'slug' => Utilities::slug($car->name)
            ]);
            $this->info("{$car->name} Slug = {$car->slug}");
        }
    }
}
