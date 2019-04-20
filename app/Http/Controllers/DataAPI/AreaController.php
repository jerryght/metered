<?php

namespace App\Http\Controllers\DataAPI;

use App\Model\country_wealth;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Model\country_area;

class AreaController extends BaseController
{
    function area ()
    {
        $totalArea = country_area::where('data_date',2017)->sum('area');
        $orderArea = country_area::where('data_date',2017)->orderBy('area','desc')->offset(0)->limit(5)->get(['country','area']);
        $tanster = array();
        $country = array();
        $n = 0;
        $other = 0;
        $this->EnglishName($orderArea);
        $this->forsubstr($orderArea,'country',15);
        foreach ($orderArea as $value)
        {
            $tanster[$n]['name'] = $value->country;
            $tanster[$n]['value'] = $value->area;
            $country[] = $value->country;
            $other += $value->area;
            $n++;
        }
        $l = count($tanster);
        $tanster[$l]['name'] = 'Other';
        $tanster[$l]['value'] = $totalArea-$other;
        echo json_encode(array( 'areaList' =>$tanster,'countryList' => $country));
    }
}
