<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login','User\UserController@login');
Route::get('/index','Main\ShowController@index');
Route::get('/acquest/aurum/shanghai','Acquest\AurumController@shanghai');
Route::get('/acquest/aurum/london','Acquest\AurumController@london');
Route::get('/acquest/exrate/cny','Acquest\ExrateController@CNY');
Route::get('/acquest/goods/ppi','Acquest\GoodsController@ppi');

/*data API*/
Route::get('/population','Main\ShowController@population');
Route::get('/population_growth','DataAPI\PopulationController@growth');
Route::get('/countcp','DataAPI\PopulationController@count');
Route::get('/countgnp','DataAPI\WealthController@gnp');
Route::get('/pochi','DataAPI\ChinaController@population');
Route::get('/tarea','DataAPI\AreaController@area');


/* temp */
Route::get('/area','TempTools\TotalGDPController@area');
Route::get('/cinfo','TempTools\TotalGDPController@country');
Route::get('/company','TempTools\StockController@company');
Route::get('/country','TempTools\TotalGDPController@population');
Route::get('/countrygdp','TempTools\TotalGDPController@everyCountryGDP');
Route::get('/currency','TempTools\CurrencyController@baseinfo');
Route::get('/house','TempTools\HouseController@index');
Route::get('/propopu','TempTools\TotalGDPController@propopu');
Route::get('/shenzhen','Acquest\StockController@shenzhen');
Route::get('/stock','TempTools\TotalGDPController@sstock');
Route::get('/szstock','TempTools\StockController@shenzhen');
Route::get('/totalgdp','TempTools\TotalGDPController@gdp');
Route::get('/updatas','TempTools\TotalGDPController@updateCou');
