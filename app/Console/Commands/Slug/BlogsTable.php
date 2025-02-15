<?php

namespace App\Console\Commands\Slug;

use App\Helpers\Utilities;
use App\Models\Blog;
use App\Models\Currency;
use Illuminate\Console\Command;

class BlogsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:slug-blogs';

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
        foreach (Blog::all() as $blog) {
            $this->info("Updating {$blog->title}");
            $blog->update([
                'slug' => Utilities::slug($blog->title)
            ]);
            $this->info("{$blog->title} Slug = {$blog->slug}");
        }
    }
}
