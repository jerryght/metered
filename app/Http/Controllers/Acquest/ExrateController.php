<?php

namespace app\Http\Controllers\Acquest;

use App\Http\Controllers\Acquest\BaseController;
use App\Model\currency;
use App\Model\exrate_cny;
use Illuminate\Support\Facades\DB;

class ExrateController extends BaseController
{

    function CNY()
    {
        $url = 'https://huobiduihuan.51240.com/';
        $data = $this->getTable($url,'.xiaoshuomingkuang_neirong');
        $fields = array();
        foreach($data as $value){
            $transter = array_reverse(explode(' ',$value[0]));
            if(!isset($transter[1]) || $transter[0] === '(CNY)'){
                continue;
            }
            $fields['currency_id'] = currency::where('chinese_name',$transter[1])->get(['id'])[0]->id;
            $fields['price'] = $transter[2];
            $fields['trading_time'] = $value[1];
            DB::transaction(function() use ($fields){
                exrate_cny::create($fields);
            });
        }
    }
}
