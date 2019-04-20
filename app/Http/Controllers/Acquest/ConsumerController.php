<?php

namespace App\Http\Controllers\Acquest;

use App\Model\consumer;
use App\Model\industrial;
use App\Model\producer;
use Illuminate\Support\Facades\DB;

class ConsumerController extends BaseController
{
    function cpi()
    {
        for($page=1; $page<1; $page++)
        {
            $url = 'http://data.eastmoney.com/cjsj/consumerpriceindex.aspx?p='.$page;
            $table = $this->getTable($url,'#tb','tr:gt(1)');
            $fields = array();
            for ($n=0,$l=count($table)-1; $n<$l; $n++)
            {
                $fields['data_date'] = $table[$n][0];
                $fields['index'] = $table[$n][1];
                $fields['basis'] = substr($table[$n][2],0,-1);
                $fields['ratio'] = substr($table[$n][3],0,-1);
                $fields['total'] = $table[$n][4];
                DB::transaction(function  () use ($fields)
                {
                    consumer::create($fields);
                },3);
            }
        }
    }

    function ppi()
    {
        for($page=1; $page<1; $page++){
            $url = 'http://data.eastmoney.com/cjsj/productpricesindex.aspx?p='.$page;
            $table = $this->getTable($url,'#tb');
            for($n=0,$l=count($table)-1; $n<$l; $n++)
            {
                $fields['data_date'] = $table[$n][0];
                $fields['index'] = $table[$n][1];
                $fields['basis'] = substr($table[$n][2],0,-1);
                $fields['total'] = $table[$n][3];
                DB::transaction(function  () use ($fields)
                {
                    producer::create($fields);
                },3);
            }

        }
    }

    function industrial()
    {

        for($page = 1; $page<1; $page++){
            $url = 'http://data.eastmoney.com/cjsj/industryincrementspeed.aspx?p='.$page;
            $table = $this->getTable($url,'#tb');
            for($n=0,$l=count($table)-1; $n<$l; $n++)
            {
                $fields['data_date'] = substr($table[$n][0],0,-3);
                $fields['basis'] = $table[$n][1];
                $fields['total'] = $table[$n][2];
                DB::transaction(function  () use ($fields)
                {
                    industrial::create($fields);
                },3);
            }
        }
    }
}
