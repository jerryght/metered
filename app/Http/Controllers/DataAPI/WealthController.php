<?php

namespace App\Http\Controllers\DataAPI;

use App\Model\country_wealth;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use test\Mockery\Adapter\Phpunit\BaseClassStub;
use Illuminate\Support\Facades\DB;

class WealthController extends BaseController
{
    function gnp(){
        //DB::connection()->enableQueryLog();
        $data = country_wealth::orderBy('gnpCapPPP','desc')->offset(0)->limit(30)->get(['gnpCapPPP','gnpCapUSD']);
        $transter = array();
        $n = 0;
        foreach ($data as $datum) {
            $transter[$n][] = $datum->gnpCapPPP;
            $transter[$n][] = $datum->gnpCapUSD;
            $n++;
        }
        echo json_encode($transter);
    }
}
