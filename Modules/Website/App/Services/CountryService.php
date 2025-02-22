<?php 

namespace Modules\Website\App\Services;

use App\Models\Country;

class CountryService
{
    protected $country;
    protected $city = null;

    public function setCountry($countryId)
    {
        $this->country = Country::find($countryId);
        $this->city    = $this->country->cities()->whereDefault(true)->first()->id;
    }

    public function getCountry()
    {
        return $this->country;
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
        $this->city = $cityId ? $this->country->cities->where("id", $cityId)->first() : null;
    }

    public function getCity()
    {
        return $this->city;
    }
}