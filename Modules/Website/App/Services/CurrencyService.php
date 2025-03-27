<?php 

namespace Modules\Website\App\Services;

use App\Models\Currency;

class CurrencyService {

    protected $currency;

    public function getAllCurrencies() {
        return Currency::orderBy("id","asc")->get();
    }

    public function setCurrency($id) {
        $this->currency = Currency::find($id) ?? Currency::whereDefault(true)->first() ?? Currency::first();
    }

    public function getCurrency() {
        return $this->currency;
    }

    public function convert($amount) {
        return $amount * $this->currency->aed_rate;
    }

    public function getAedAmount($amount) {
        return $amount * 1 / $this->currency->aed_rate;
    }
}