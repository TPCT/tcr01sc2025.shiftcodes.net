<?php 

namespace Modules\Website\App\Services;

use App\Models\Currency;

class CurrencyService {

    protected $currency;

    public function getAllCurrencies() {
        return Currency::orderBy("id","asc")->get();
    }

    public function setCurrency($id) {
        $this->currency = Currency::find($id);
    }

    public function getCurrency() {
        return $this->currency ?? Currency::find(session('currency_id'));
    }

    public function convert($amount) {
        return $amount * $this->currency->aed_rate;
    }
}