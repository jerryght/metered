<?php

namespace App\Http\Controllers\TempTools;

use App\Http\Controllers\Acquest\BaseController;
use App\Model\currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CurrencyController extends BaseController
{
    function baseinfo(){
        $url = 'https://huobiduihuan.51240.com/';
        $data = $this->getTable($url,'.xiaoshuomingkuang_neirong');
        $fields = array();
        foreach($data as $value){
            $currency = array_reverse(explode(' ',$value[0]));
            if(!isset($currency[1])){
                continue;
            }
            $fields['english_name'] = substr($currency[0],1,3);
            $fields['chinese_name'] = $currency[1];
            DB::transaction(function() use ($fields){
                currency::create($fields);
            });
        }
    }
}
