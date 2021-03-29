<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

////Главная страница
//Route::get('/', function () {
//    return view('auth.login');
//});
//
////Home page for authorised user
//Route::view('home', 'home')->middleware('auth');

//Маршрут
Route::get('/currency', [CurrencyController::class, 'currency'])
    ->name('currency');
