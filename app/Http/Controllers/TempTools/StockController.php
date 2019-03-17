<?php

namespace App\Http\Controllers\TempTools;

use QL;
use Illuminate\Http\Request;
use App\Model\shenzhen_stock;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    function toInt($num){
           return str_replace(',','',$num );
    }

    function shenzhen(){
        set_time_limit(0);
        $url = 'http://www.szse.cn/api/report/ShowReport/data?SHOWTYPE=JSON&CATALOGID=1110&TABKEY=tab1&';
        $n = 59;
        $pageEnd = 107;
        $fields = array();
        while($n <= $pageEnd){
            setcookie('page',$n,time()+3600*5);
            $page = 'PAGENO='.$n;
            $random ='&random=0.'.mt_rand(100000000,1999999999).mt_rand(1000000,9999999);
            $data = json_decode(file_get_contents($url.$page.$random));
            die;
            foreach($data[0]->data as $value){
                $fields['company_code'] = $value->zqdm;
                $fields['name_simple'] = strip_tags($value->gsjc);
                $fields['a_code'] = $value->agdm;
                $fields['a_simple'] = $value->agjc;
                $fields['a_date'] = $value->agssrq;
                DB::transaction(function  () use ($fields){
                    shenzhen_stock::create($fields);
                },3);
            }
            $n++;
        }

    }

    function company(){
        set_time_limit(0);
        ini_set('arg_separator.output','&');
        $list = shenzhen_stock::where('id','>',1951)->get(['id','a_code']);
        $fields = array();
        foreach($list as $value){
            $random = mt_rand(10000000,99999999).mt_rand(10000000,99999999).'\&secCode=';
            $code = $value->a_code;
            $url = 'http://www.szse.cn/api/report/index/companyGeneralization?random=0.'.$random.$code;
            $data = json_decode(file_get_contents($url))->data;
            $fields['chinese_name'] = $data->gsqc ?: null;
            $fields['english_name'] = $data->ywqc ?: null;
            $fields['b_code'] = $data->bgdm ?: null;
            $fields['b_simple'] = $data->bgjc ?: null;
            $fields['b_date'] = $data->bgssrq ?: null;
            $fields['a_capital'] = $this->toInt($data->agzgb) ?: null;
            $fields['b_capital'] = $this->toInt($data->bgzgb) ?: null;
            $fields['a_active'] = $this->toInt($data->agltgb) ?: null;
            $fields['b_active'] = $this->toInt($data->bgltgb) ?: null;
            $fields['address'] = $data->zcdz ?: null;
            $fields['area'] = $data->dldq ?: null;
            $fields['province'] = $data->sheng ?: null;
            $fields['city'] = $data->shi ?: null;
            $fields['industry'] = $data->sshymc ?: null;
            $fields['type'] = 'A';
            $fields['www'] = $data->http ?: null;
            die;
            DB::transaction(function  () use ($fields,$value){
                shenzhen_stock::where('id',$value->id)->update($fields);
            },3);
        }
    }

    function getTable(string $url,string $table){
        $html = file_get_contents($url);
        $table = QL\QueryList::html($html)->find($table);
        return $table->find('tr')->map(function($row){
            return $row->find('td')->texts()->all();
        });
    }
}
