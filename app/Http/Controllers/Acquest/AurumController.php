<?php
/**
 * Created by PhpStorm.
 * User: liaoliao
 * Date: 2018/9/5
 * Time: 10:46
 */
namespace app\Http\Controllers\Acquest;

use QL;
use App\Model\china;
use App\Model\shanghai_au;
use App\Events\OrderShipped;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Acquest\BaseController;

class AurumController extends BaseController
{
    function shanghai()
    {
        $host = 'http://www.sge.com.cn/';
        $spider = new QL\QueryList();
        $html = file_get_contents($host.'sjzx/mrhqsj');
        $rules = array(
            'link' => array('.articleList>ul>li:eq(0)>a','href'),
            'date' => array('.articleList>ul>li:eq(0)>a>.fr','text'),
        );
        $link = $spider->html($html)->rules($rules)->query()->getData();
        $updated_at = $link[0]['date'];
        //$this->isDate(new shanghai_au(),$updated_at);
        $exactAddr = $host.$link[0]['link'];

        $html = file_get_contents($exactAddr);
        $rules = array(
            'price' =>array('.ke-zeroborder>tbody>tr:eq(2)>td:eq(4)','text'),
            'weight' =>array('.ke-zeroborder>tbody>tr:eq(2)>td:eq(8)','text'),
            'amounts' =>array('.ke-zeroborder>tbody>tr:eq(2)>td:eq(9)','text'),
        );
        $result = $spider->html($html)->rules($rules)->query()->getData();
        $arr = $result->all();
        $price = $arr[0]['price'];
        $weight = str_replace(',','',$arr[0]['weight']);
        $amounts= str_replace(',','',$arr[0]['amounts']);
        $attributes = array('price'=>$price, 'weight'=>$weight, 'amounts'=>$amounts, 'data_date'=>$updated_at);
            $r = shanghai_au::firstOrCreate($attributes);
            dd($r);
        DB::transaction(function() use ($attributes)
        {
            shanghai_au::firstOrCreate($attributes);
        });
    }

    function london(){

    }
}
