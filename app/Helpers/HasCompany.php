<?php

namespace App\Helpers;

trait HasCompany
{
    public function scopeHasCompany($query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->whereHas('company', function ($query){
            $query->where('status', true);
            $query->where('country_id', app('country')->getCountry()->id);
            if ($city = app('country')->getCity()) {
                $query->whereHas('cities', function ($query) use ($city) {
                    $query->where('city_id', $city->id);
                });
            }
        });
    }
}