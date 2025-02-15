<?php

namespace App\Console\Commands\Slug;

use App\Helpers\Utilities;
use App\Models\Company;
use App\Models\Country;
use Illuminate\Console\Command;

class CompaniesTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:slug-companies';

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
        foreach (Company::all() as $company) {
            $this->info("Updating {$company->name}");
            $company->update([
                'slug' => Utilities::slug($company->name)
            ]);
            $this->info("{$company->title} Slug = {$company->slug}");
        }
    }
}
