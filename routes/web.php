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
Route::get('/cpi','Acquest\ConsumerController@cpi');
Route::get('/ppi','Acquest\ConsumerController@ppi');
Route::get('/industrial','Acquest\ConsumerController@industrial');

/*data API*/
Route::group(['prefix' => 'interface','namespace' => 'DataAPI'], function(){
    Route::get('industry','IndustrialController@index');
    Route::get('population_growth','PopulationController@growth');
    Route::get('countcp','PopulationController@count');
    Route::get('countgnp','WealthController@gnp');
    Route::get('pochi','ChinaController@population');
    Route::get('tarea','AreaController@area');
});

Route::group(['namespace' => 'TempTools'], function(){
    Route::get('area','TotalGDPController@area');
    Route::get('cinfo','TotalGDPController@country');
    Route::get('company','StockController@company');
    Route::get('country','TotalGDPController@population');
    Route::get('countrygdp','TotalGDPController@everyCountryGDP');
    Route::get('currency','CurrencyController@baseinfo');
    Route::get('propopu','TotalGDPController@propopu');
    Route::get('stock','TotalGDPController@sstock');
    Route::get('szstock','StockController@shenzhen');
    Route::get('totalgdp','TotalGDPController@gdp');
    Route::get('updatas','TotalGDPController@updateCou');
    Route::get('blog/{article}', 'BlogController@showPost');
    Route::get('neig', 'HouseController@neig');
    Route::get('neigPlus', 'HouseController@neigPlus');
    Route::get('tarding', 'HouseController@tarding');
    Route::get('ajax', 'HouseController@ajax');

});
Route::get('/shenzhen','Acquest\StockController@shenzhen');
