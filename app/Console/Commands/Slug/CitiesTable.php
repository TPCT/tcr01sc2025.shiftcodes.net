<?php

namespace App\Console\Commands\Slug;

use App\Helpers\Utilities;
use App\Models\City;
use App\Models\Country;
use Illuminate\Console\Command;

class CitiesTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:slug-cities';

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
        foreach (City::all() as $city) {
            $this->info("Updating {$city->title}");
            $city->update([
                'slug' => Utilities::slug($city->title)
            ]);
            $this->info("{$city->title} Slug = {$city->slug}");
        }
    }
}
