<?php

namespace App\Http\Controllers;


use App\Services\GetCurrencyService;

class CurrencyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function currency(GetCurrencyService $getCurrencyService)
    {
        //Get list of currencies
        dd($getCurrencyService->execute());
    }

}
