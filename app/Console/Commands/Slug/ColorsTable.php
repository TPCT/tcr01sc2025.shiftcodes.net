<?php

namespace App\Console\Commands\Slug;

use App\Helpers\Utilities;
use App\Models\Color;
use App\Models\Company;
use App\Models\Type;
use Illuminate\Console\Command;

class ColorsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:slug-colors';

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
        foreach (Color::all() as $color) {
            $this->info("Updating {$color->title}");
            $color->update([
                'slug' => Utilities::slug($color->title)
            ]);
            $this->info("{$color->title} Slug = {$color->slug}");
        }
    }
}
