<?php

namespace App\Console\Commands\PageTitle;

use App\Helpers\Utilities;
use App\Models\Company;
use App\Models\Models;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class ModelsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:page-title-models';

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
        foreach (Models::all() as $model) {
            $model->update([
                'page_title' => [
                    'en' => "Rent " . $model->translate('title'),
                    'ar' =>  "تاجير " . $model->translate('title'),
                    'ru' =>  "Rent " . $model->translate('title'),
                ]
            ]);
        }
    }
}
