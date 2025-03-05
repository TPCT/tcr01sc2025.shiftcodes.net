<?php 

namespace Modules\Website\App\Services;

use App\Models\City;
use App\Models\Country;

class CountryService
{
    protected $country;
    protected $city = null;

    public function setCountry($countryId)
    {
        $this->country = Country::find($countryId) ?? Country::whereDefault(true)->first() ?? Country::first();
        $this->setCity($this->country->cities()->whereDefault(true)->first()->id);
    }

    public function getCountry()
    {
        return $this->country ?? Country::find(session('country_id')) ?? Country::whereDefault(true)->first();
    }

    public function getAllCountries()
    {
        $countries = Country::orderBy("id", "asc")->get();
        return $countries;
    }

    public function getCities() {
        return $this->country->cities;
    }

    public function setCity($cityId)
    {
        $this->city = City::find($cityId) ?? City::whereDefault(true)->first() ?? City::first();
    }

    public function getCity()
    {
        return $this->city ?? City::find(session('city_id')) ?? City::whereDefault(true)->first();
    }
}