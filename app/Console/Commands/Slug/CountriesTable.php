<?php

namespace App\Console\Commands\Slug;

use App\Helpers\Utilities;
use App\Models\Country;
use App\Models\Currency;
use Illuminate\Console\Command;

class CountriesTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:slug-countries';

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
        foreach (Country::all() as $country) {
            $this->info("Updating {$country->title}");
            $country->update([
                'slug' => Utilities::slug($country->title)
            ]);
            $this->info("{$country->title} Slug = {$country->slug}");
        }
    }
}
