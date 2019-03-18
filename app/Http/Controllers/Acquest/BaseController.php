<?php

namespace App\Http\Controllers\Acquest;

use QL;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    function __construct(){
        set_time_limit(0);
        ignore_user_abort(true);
    }

    /*以指定规则筛选一条数据*/
    function getData(string $url,array $rules){
        $spider = new QL\QueryList();
        $html = file_get_contents($url);
        return $spider->html($html)->rules($rules)->query()->getData();
    }

    /*表格数据筛选, $table jquery标签选择器*/
    function getTable(string $url,string $table){
        $html = file_get_contents($url);
        $table = QL\QueryList::html($html)->find($table);
        return $table->find('tr:gt(0)')->map(function($row){
            return $row->find('td')->texts()->all();
        });
    }


    function isDate($model,$updated_at,$field='data_date')
    {
        $data = $model->orderBy($field,'desc')->pluck($field)->first();
        $date = substr($data,0,10);
        if($updated_at === $date)
        {
            die('没有数据更新');
        }
    }

    function get(string $url){
        $con = curl_init($url);
        curl_setopt($con, CURLOPT_HEADER, false);
        curl_setopt($con, CURLOPT_RETURNTRANSFER,true);
        return curl_exec($con);
    }

}
