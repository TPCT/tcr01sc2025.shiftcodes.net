<?php

namespace App\Console\Commands\Slug;

use App\Helpers\Utilities;
use App\Models\Company;
use App\Models\Type;
use Illuminate\Console\Command;

class TypesTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:slug-types';

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
        foreach (Type::all() as $type) {
            $this->info("Updating {$type->title}");
            $type->update([
                'slug' => Utilities::slug($type->title)
            ]);
            $this->info("{$type->title} Slug = {$type->slug}");
        }
    }
}
