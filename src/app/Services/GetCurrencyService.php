<?php

namespace App\Services;

use App\Models\Currency;

class GetCurrencyService extends BaseService
{

    /**
     * @return array
     *
     *  Get list of currencies
     */
    public function execute()
    {
        $allCurrencies = Currency::all()->toArray();

        $name = array_column($allCurrencies, 'name');
        $rate = array_column($allCurrencies, 'rate');
        $result = array_combine($name, $rate);

        return $result;
    }

}
