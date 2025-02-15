<?php

namespace App\Console\Commands\Slug;

use App\Helpers\Utilities;
use App\Models\Currency;
use Illuminate\Console\Command;

class CurrenciesTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:slug-currencies';

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
        foreach (Currency::all() as $currency) {
            $this->info("Updating {$currency->name}");
            $currency->update([
                'slug' => Utilities::slug($currency->name)
            ]);
            $this->info("{$currency->name} Slug = {$currency->slug}");
        }
    }
}
