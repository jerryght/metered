<?php

namespace App\Http\Controllers\Acquest;

use Illuminate\Database\Concerns\BuildsQueries;
use QL;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    function __construct(){
        set_time_limit(0);
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

    /*周六周日没有业务的平台, 不执行数据抓取*/
    function isWeek(){
        $week = date('w');
        switch($week){
            case '6':
                die('星期六平台暂停业务,没有数据更新');
            case '0':
                die('星期日平台暂停业务,没有数据更新');
        }
    }

}
