<?php

namespace App\Http\Controllers\Acquest;

use App\Model\shenzhenA_trend;
use Illuminate\Http\Request;
use App\Http\Controllers\Acquest\BaseController;
use App\Model\shenzhen_stock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class StockController extends BaseController
{
    function shenzhen()
    {
        /*深交所上市公司统计:http://www.szse.cn/api/report/index/overview/onepersistentday/szse?random=0.06135583769645958*/
        $url = 'http://www.szse.cn/api/market/ssjjhq/getTimeData?random=0.596561703907485&marketId=1&code=399001';
        $data = $this->get($url);
        $data = json_decode($data);
        $this->isDate(new shenzhenA_trend(),substr($data->datetime,0,10));


        /*出现意外错误, 重新执行抓取完整数据*/
        $countFile = 'storage/count.txt';
        $currentDate = date('Y-m-d',time());
        $countString = Storage::get($countFile);
        $countDate = substr($countString,0,10);
        if($currentDate === $countDate)
        {
            $id = substr($countString,10,-1);
            $stockCode = shenzhen_stock::where('id','>',$id)->get(['id','a_code']);
            unset($id);
        } else {
            $stockCode = shenzhen_stock::get(['id','a_code']);
        }
        $fields = array();
        foreach($stockCode as $value)
        {
            $random = mt_rand(10000000,99999999).mt_rand(10000000,99999999);
            $url = 'http://www.szse.cn/api/market/ssjjhq/getTimeData?random=0.'.$random.'&marketId=1&code='.$value->a_code;
            $data = $this->get($url);
            $data = json_decode($data)->data;
            if($data->open === null)
            {
                continue;
            }
            $fields['shenzhen_id'] = $value->id;
            $fields['open'] = $data->open;
            $fields['close'] = $data->now;
            $fields['high'] = $data->high;
            $fields['low'] = $data->low;
            $fields['volume'] = (float)str_replace(',','',$data->volume);
            $fields['amount'] = (float)str_replace(',','',$data->amount);
            $fields['increase'] = $data->delta;
            $fields['growth'] = $data->deltaPercent;
            $fields['trading_day'] = $data->marketTime;
            $url = 'http://www.szse.cn/api/report/index/stockKeyIndexGeneralization?random=0.'.$random.'&secCode='.$value->a_code;
            $data = $this->get($url);
            $data = json_decode($data)->data;
            $fields['monery_change'] = (float)str_replace(',','',$data[2]->change_sjzz);
            $data = $data[0];
            $fields['monery'] = (float)str_replace(',','',$data->now_sjzz);
            $fields['active_monery'] = (float)str_replace(',','',$data->now_ltsz);
            $fields['capitalization'] = (float)str_replace(',','',$data->now_zgb);
            $fields['active_capital'] = (float)str_replace(',','',$data->now_ltgb);
            Storage::disk('local')->put($countFile,$currentDate.$value->id.'_');
            DB::transaction(function  () use ($fields,$value)
            {
                shenzhenA_trend::create($fields);
            },3);
        }

    }
}
