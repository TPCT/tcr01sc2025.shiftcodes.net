<?php

namespace App\Console\Commands\Slug;

use App\Helpers\Utilities;
use App\Models\Blog;
use App\Models\Car;
use App\Models\City;
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
            $car->update([
                'slug' => Utilities::slug($car->name)
            ]);
        }

        $common_slugs = [];
        foreach (Car::all() as $car) {
            if (!isset($common_slugs[$car->slug])) {
                $common_slugs[$car->slug] = [$car->id];
            }else{
                $common_slugs[$car->slug][] = $car->id;
            }
        }

        foreach ($common_slugs as $slug => $car_ids) {
            if (count($car_ids) == 1) {
                $car = Car::find($car_ids[0]);
                $car->update([
                    'slug' => Utilities::slug($car->name)
                ]);
            }

            foreach ($car_ids as $index => $car_id) {
                $car = Car::find($car_ids[0]);
                $this->info("Updating {$car->name}");
                $car->update([
                    'slug' => Utilities::slug($car->name . ' ' . $index + 1)
                ]);
                $this->info("{$car->name} Slug = {$car->slug}");
            }
        }
    }
}
