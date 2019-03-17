<?php

namespace App\Http\Controllers\Acquest;

use Illuminate\Http\Request;
use App\Model\goods_trend;
use App\Model\goods_info;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Acquest\BaseController;

class GoodsController extends BaseController
{
    /*
     * 生意社大宗商品价格统计
     * 抓取：每种商品每天的价格这一个字段
     * 商品固定信息：名称,类型,单独一张表存储
    */
    function ppi()
    {
        $url = 'http://www.100ppi.com/monitor/';
        $rules = array(
            'lastDate' => array('.right>table>tr:eq(0)>td:eq(2)','text'),
        );
        $date = $this->getData($url,$rules);
        $date = substr($date[0]['lastDate'],-11,-1);
        $this->isDate(new goods_trend(),$date,'price_date');
        $data = $this->getTable($url,'.right>table');
        $category = null;
        foreach($data as $value)
        {
            if(count($value) === 1)
            {
                $category = $value[0];
                continue;/*商品类型,没有具体数据*/
            }
            if(!$value[2])
            {
                continue;
            }
            $info_id = goods_info::where('name',$value[0])->get(['id']);
            if(count($info_id) === 0)
            {
                /*没有这个商品，添加其信息*/
                goods_info::create([
                    'name' => $value[0],
                    'category' => $category
                ]);
                $info_id = goods_info::where('name',$value[0])->get(['id']);
            }
            $fields = array(
                'info_id' => $info_id[0]->id,
                'price' => $value[2],
                'price_date' => $date
            );
            DB::transaction(function  () use ($fields)
            {
                goods_trend::create($fields);
            },3);
        }
    }
}
