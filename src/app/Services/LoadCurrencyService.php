<?php

namespace App\Services;

use App\Models\Currency;
use SimpleXMLElement;
use Exception;

class LoadCurrencyService extends BaseService
{

    /**
     * @const CURRENCY_XML
     *
     * Store path to load currency data
     */
    private const CURRENCY_XML = 'http://www.cbr.ru/scripts/XML_daily.asp';

    /**
     * @return bool
     *
     * Load up to date currency data
     */
    public function execute()
    {
        //Load XML file
        $loadedData = $this->loadCurrencyXML();

        //Parse XML file
        if($loadedData['status'] == 200)
            $parsedData = $this->parseCurrencyXML($loadedData['data']);
        else
            return false;

        //Save parsed data to table
        $this->storeCurrencyData($parsedData);

        return true;
    }


    /**
     * @return array|int[]
     *
     * Load XML file with data
     */
    private function loadCurrencyXML()
    {
        //status
        $result = ['status' => 200];

        //try to load content
        try {
            $result['data'] = file_get_contents(self::CURRENCY_XML);
        }
        catch (Exception $e) {//generate exception
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return $result;
    }

    /**
     * @param string $dataXML
     * @return array
     *
     * Load XML file with data
     */
    private function parseCurrencyXML($dataXML)
    {
        //using Simple XML Element and json to parse data
        $json = json_encode(new SimpleXMLElement((string)$dataXML));
        $rawListOfValutes = json_decode($json, true)['Valute'];

        $listOfValutes = [];
        foreach ($rawListOfValutes as $valute)
        {
            if(array_key_exists('CharCode', $valute) && array_key_exists('Value', $valute))
                $listOfValutes[$valute['CharCode']] = $valute['Value'];
        }

        return $listOfValutes;
    }

    /**
     * @param array $currencyData
     *
     * Store (create or update) currency data to table
     */
    private function storeCurrencyData($currencyData)
    {
        foreach($currencyData as $key => $value)
            Currency::updateOrCreate(['name' => $key], ['rate' => str_replace(',','.', $value)]);

    }
}
