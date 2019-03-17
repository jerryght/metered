<?php
/**
 * Created by PhpStorm.
 * User: liaoliao
 * Date: 2018/9/5
 * Time: 10:46
 */
namespace app\Http\Controllers\Acquest;

use QL;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Aurum;

class AurumController extends Controller{

    function shanghai(){
        ignore_user_abort(true);
        set_time_limit(0);
        $this->autoRun(__FUNCTION__);
        $user = new Aurum();
        $user ->fillable(['market', 'price','weight','amounts','tradingDay']);
        //$user ->fill(['name' => 'Bruce Lee', 'age' => 18]);
        $host = 'http://www.sge.com.cn/';
        $spider = new QL\QueryList();
        $html = file_get_contents($host.'sjzx/mrhqsj');
        $rules = array(
            'link' => array('.articleList>ul>li:eq(0)>a','href'),
        );
        $link = $spider->html($html)->rules($rules)->query()->getData();
        $exactAddr = $host.$link[0]['link'];

        $html = file_get_contents($exactAddr);
        $rules = array(
            'price' =>array('.ke-zeroborder>tbody>tr:eq(2)>td:eq(4)','text'),
            'weight' =>array('.ke-zeroborder>tbody>tr:eq(2)>td:eq(8)','text'),
            'amounts' =>array('.ke-zeroborder>tbody>tr:eq(2)>td:eq(9)','text'),
            'tradingDay' =>array('.jzk_newsCenter_meeting>.title>p>span:eq(1)','text')
        );
        $result = $spider->html($html)->rules($rules)->query()->getData();
        $arr = $result->all();
        $market = '上海';
        $price = $arr[0]['price'];
        $weight = str_replace(',','',$arr[0]['weight']);
        $amounts= str_replace(',','',$arr[0]['amounts']);
        $tradingDay = iconv_substr($arr[0]['tradingDay'],3);
        $attributes = array('market'=>$market, 'price'=>$price, 'weight'=>$weight, 'amounts'=>$amounts, 'tradingDay'=>$tradingDay);
        //$user->fill($attributes);
        //$user ->save();die;
        Aurum::create($attributes);
    }

    function london(){
        $host = 'http://lbma.oblive.co.uk/api/today/both.json';
        $json_str = file_get_contents($host);
        $data = json_decode($json_str, true);
        $price = $data['gold']['pm']['usd'];
        $month = substr($data['gold']['pm']['timestamp'],0);
        $tradingDay = "'".date('Y',time()).'-'.substr($month,3,2).'-'.substr($month,0,2).' '.substr($month,6)."'";
        $created = "'".date("Y-m-d H:i:s",time())."'";
        $whether = DB::insert("insert into aurums (market,tradingDay,price,created) values ('伦敦', $tradingDay, $price, $created)");
    }
}
