<?php 

namespace Modules\Website\App\Services;

class CarsService
{
    public $brands = [];

    public function __construct()
    {
        $this->brands = \App\Models\Brand::withCount('cars')->orderBy('cars_count', 'desc')->get();
    }

}