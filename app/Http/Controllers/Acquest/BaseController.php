<?php

namespace App\Http\Controllers\Acquest;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
    function getTable(string $url,string $table,string $tr='tr:gt(0)'){
        $html = file_get_contents($url);
        $table = QL\QueryList::html($html)->find($table);
        return $table->find($tr)->map(function($row){
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


    function get_http_contents($url){
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//绕过ssl验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        //释放curl句柄
        curl_close($ch);
        return $output;
    }

    function post(string $url, $data=null){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    function fsubstr(&$lis, $start, $len, $attr='id'){
        foreach($lis as &$val){
            $val[$attr] = substr($val[$attr], $start, $len);
        }
    }

    function save($model, $data, array $attr=[]){
        if($attr !== []){
            foreach($data as &$val){
                foreach($attr as $k=>$v){
                    $val[$k] = $v;
                }
            }
        }
        foreach($data as $val){
            DB::transaction(function() use ($model,$val)
            {
                $model::firstOrCreate($val);
            });
        }
    }

}
