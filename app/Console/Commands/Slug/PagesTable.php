<?php

namespace App\Console\Commands\Slug;

use App\Helpers\Utilities;
use App\Models\Company;
use App\Models\Page;
use App\Models\Type;
use Illuminate\Console\Command;

class PagesTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:slug-pages';

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
        foreach (Page::all() as $type) {
            $this->info("Updating {$type->name}");
            $type->update([
                'slug' => Utilities::slug($type->name)
            ]);
            $this->info("{$type->name} Slug = {$type->slug}");
        }
    }
}
