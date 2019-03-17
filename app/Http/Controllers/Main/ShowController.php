<?php
/**
 * Created by PhpStorm.
 * User: liaoliao
 * Date: 2018/8/26
 * Time: 0:41
 */
namespace app\Http\Controllers\Main;

use App\Model\Country;
use QL;
use Illuminate\Support\Facades\DB;
use App\Model\Country_area;
use App\Http\Controllers\BaseController;

class ShowController extends BaseController{

    function index(){
        $land = Country_area::where('data_date',2017)->orderBy('area','desc')->offset(0)->limit(5)->get(['country','area'])->toArray();
        $this->EnglishName($land);
        $this->forsubstr($land,'country',15);
        return view('Main\index',['land'=>$land]);
    }

    function population(){
        $data = DB::select('select population,`data_date` from history_total_population where `data_date`%3=2');
        $year = array();
        $population = array();
        for($i=0; $i<count($data); $i++){
            $year[] = $data[$i]->year;
            $population[] = $data[$i]->population;
        }
        echo json_encode(array('years'=>$year,'population'=>$population));
    }
    function money(){
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
            'price' =>array('.ke-zeroborder>tbody>tr:eq(2)>td:eq(4)','text')
            // content compare
            //'price' =>array('.ke-zeroborder>tbody>tr>td:contains("Au99.95")','text')
        );
        $result = $spider->html($html)->rules($rules)->query()->getData();
        $inset = $result->all();
        $price = $inset[0]['price'];
        $dated = "'".date("Y-m-d H:i:s",time())."'";
        DB::insert("insert into aurum (market,price,dated) values ('上海', $price, $dated)");
    }
}