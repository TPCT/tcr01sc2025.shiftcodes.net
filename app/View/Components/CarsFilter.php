<?php

namespace App\View\Components;

use App\Helpers\Utilities;
use App\Models\Car;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CarsFilter extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    public function render(): View|Closure|string
    {
        $query = Utilities::getCarsFilterQuery();
        $max_price = app('currencies')->convert((clone $query)->max('price_per_day'));
        return view('website::cars.parts.filters', [
            'selected-types' => request('types', []),
            'max_price'     => $max_price,
        ]);
    }
}
