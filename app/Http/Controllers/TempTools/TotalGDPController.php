<?php
/**
 * Created by PhpStorm.
 * User: liaoliao
 * Date: 2019/1/14
 * Time: 0:10
 */
namespace app\Http\Controllers\TempTools;

use App\Model\china;
use App\Model\history_stock;
use Egulias\EmailValidator\Warning\ObsoleteDTEXT;
use QL;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use App\Model\World_wealth;
use App\Model\country_wealth;
use App\Model\Country_area;
use App\Model\Country;

class TotalGDPController extends Controller{
    function index(){
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
        //DB::insert("insert into aurum (market,price,dated) values ('上海', $price, $dated)");
    }

    function population(){
        function get_data($url){
            $host= $url.$_GET['year'].'.html';
            $html = file_get_contents($host);
            $table = QL\QueryList::html($html)->find('.table');
            $data = $table->find('tr:gt(0)')->map(function($row){
                return $row->find('td:gt(0)')->texts()->all();
            });
            return $data;

        }
        $object_population = get_data('https://www.kuaiyilicai.com/stats/global/yearly/g_population_total/');
        $newborn = get_data('https://www.kuaiyilicai.com/stats/global/yearly/g_population_fertility_perc/');
        $newborn_sex_ratio = get_data('https://www.kuaiyilicai.com/stats/global/yearly/g_population_sex_ratio_at_birth/');
        $increase = get_data('https://www.kuaiyilicai.com/stats/global/yearly/g_population_growth_perc/');
        $man = get_data('https://www.kuaiyilicai.com/stats/global/yearly/g_population_male_perc/');
        $woman = get_data('https://www.kuaiyilicai.com/stats/global/yearly/g_population_female_perc/');

        /*转普通数组*/
        $population = $object_population->all();

        function compush($l,&$m,$column){
            foreach($l as $every){
                foreach($m as &$key){
                    if($every !== array() && $key !== array()){
                        if($every[0] === $key[0]){
                            $key[$column] = floatval($every[2]);
                            break;
                        }
                    }
                }
            }
        }

        compush($newborn,$population,'newborn');
        compush($newborn_sex_ratio,$population,'newborn_sex_ratio');
        compush($increase,$population,'increase');
        compush($man,$population,'man');
        compush($woman,$population,'woman');

        foreach($population as &$every){
            if($every !== array()){
            }else{
                continue;
            }
            if(!isset($every['newborn'])){
                $every['newborn'] = null;
            }
            if(!isset($every['newborn_sex_ratio'])){
                $every['newborn_sex_ratio'] = null;
            }

            if(!isset($every['increase'])){
                $every['increase'] = null;
            }else{
                $every['increase'] = str_replace('%','',$every['increase']);
            }

            if(!isset($every['man'])){
                $every['man'] = null;
            }else {
                $every['man'] = str_replace('%', '', $every['man']);
            }

            if(!isset($every['woman'])){
                $every['woman'] = null;
            }else{
                $every['woman'] = str_replace('%','',$every['woman']);
            }

            $index = strpos($every[2],'(');
            if($index !== false){
                $every[2] = rtrim($every[2], ')');
                $every[2] = substr($every[2], $index+1);
                $every[2] = str_replace(',','',$every[2] );
            }
            $newborn = $every['newborn'];
            $newborn_sex_ratio = $every['newborn_sex_ratio'];
            $increase= $every['increase'];
            $man= $every['man'];
            $woman= $every['woman'];
            $year= $_GET['year'].'-01-01';

            $re = DB::table('country_populations')->insert(
                [
                    'population' => intval($every[2]),
                    'newborn' => $newborn,
                    'newborn_sex_ratio' => $newborn_sex_ratio,
                    'increase' => $increase,
                    'man' => $man,
                    'woman' => $woman,
                    'country' =>$every[0],
                    'data_date' => $year,
                    'continent' => $every[1]
                ]
            );
        }
    }

    function get_data($urlid,$tag,$index=':gt(0)'){
        $urlBase = 'https://www.kuaiyilicai.com/stats/global/';
        $url = $urlBase.$urlid.'.html';
        $html = file_get_contents($url);
        $table = QL\QueryList::html($html)->find('.table');
        if($tag === 'tr'){
            /*采集多行*/
            $data = $table->find($tag)->map(function ($row) use($index){
                return $row->find('td'.$index)->texts()->all();
            });
            return $data;
        }else{
            /*采集单行*/
            $data = $table->find($tag)->texts();
        }

        if(count($data) === 0){
            return null;
        }else{
            return $data[2];
        }

    }

    function toInt($num){
        $index = strpos($num,'(');
        $percent = strpos($num,'%');
        if($percent !== false){
            return substr($num,0,-1);
        }
        if($index !== false){
            $num = rtrim($num, ')');
            $num = substr($num, $index+1);
            $num = str_replace(',','',$num );
            return floor($num);
        }else{
            return floor($num);
        }
    }

    function dataPush(&$data,$transter,$column,$index){
        $len = count($transter);
        for ($i=0; $i<$len; $i++){
            /*过滤多余数据*/
            for($m=0; $m<$len; $m++){
                if($transter[$m] === array()){
                    array_splice($transter,$m,1);
                    $len = count($transter);
                    $m--;
                    continue;
                }
                if($transter[$m][0] === '全世界' || $transter[$m][0] ==='欧盟地区'){
                    array_splice($transter,$m,1);
                    $len = count($transter);
                    $m--;
                    continue;
                }
            }
            if($len === 0){
                return false;
            }

            /*初始化$data*/
            if($data === array()){
                foreach ($transter as $value){
                    $data[$index]['country'] = $value[0];
                    $data[$index][$column] = $this->toInt($value[2]);
                    $index++;
                }
                return true;
            }

            $flag = true;
            foreach($data as &$v){

                /*追加到对应数据*/
                if($transter[$i][0]===$v['country']){
                    $v[$column] = $this->toInt($transter[$i][2]);
                    $flag = false;
                }
            }

            /*没有对应数据，则添加*/
            if($flag){
                if(!isset($transter[$i][2])){
                    continue;
                }
                $new['country'] = $transter[$i][0];
                $new[$column] = $this->toInt($transter[$i][2]);
                $data[] = $new;
            }
        }
    }

    function readWrite($len,$address,$year,$tag){
        $data = array();
        for ($i=0; $i<$len; $i++){
            foreach($address as $key => $value){
                $urlid = $value.$year;
                $tanster = $this->get_data($urlid,$tag)->all();
                $this->dataPush($data,$tanster,$key);
            }
            foreach($data as $val){
                $val['data_date'] = $year;
                Country_area::create($val);
            }
            $year++;
            $data = array();
        }
    }

    function gdp(){
        set_time_limit(0);
        $wealths['gdpusd'] = 'yearly/g_gdp/';
        $wealths['gdpppp'] = 'yearly/g_gdp_ppp/';
        $wealths['gnpppp'] = 'yearly/g_gnp_ppp/';
        $wealths['gnpusd'] = 'yearly/g_gnp_usd/';
        $wealths['gdpuavg'] = 'yearly/g_gdp_per_capita/';
        $wealths['gdppavg'] = 'yearly/g_gdp_per_capita_ppp/';
        $wealths['gnpuavg'] = 'yearly/g_gnp_per_capita/';
        $wealths['gnppavg'] = 'yearly/g_gnp_per_capita_ppp/';
        $wealths['growth'] = 'yearly/g_gdp_growth/';
        $year= 1960;
        $endYear = 2018;
        $len = $endYear-$year;
        $data = array();
        $tag = 'tr>td:contines(全世界)~td';
        for ($i=0; $i<$len; $i++){
            foreach($wealths as $key => $val){
                $urlid = $val.$year;
                $data[$key] = $this->get_data($urlid,$tag);
            }
            World_wealth::create($data);
            $year++;
        }

    }

    function everyCountryGDP(){
        set_time_limit(0);
        $wealths['gdpUSD'] = 'yearly/g_gdp/';
        $wealths['gdpPPP'] = 'yearly/g_gdp_ppp/';
        $wealths['gdpCapUSD'] = 'yearly/g_gdp_per_capita/';
        $wealths['gdpCapPPP'] = 'yearly/g_gdp_per_capita_ppp/';
        $wealths['growth'] = 'yearly/g_gdp_growth/';
        $wealths['gnpPPP'] = 'yearly/g_gnp_ppp/';
        $wealths['gnpUSD'] = 'yearly/g_gnp_usd/';
        $wealths['gnpCapUSD'] = 'yearly/g_gnp_per_capita/';
        $wealths['gnpCapPPP'] = 'yearly/g_gnp_per_capita_ppp/';
        $wealths['inflation'] = 'yearly/g_inflation_consumer_prices/';
        $wealths['broadMoney'] = 'yearly/g_broad_money_lcu/';
        $wealths['broMonRat'] = 'yearly/g_broad_money_in_gdp/';
        $wealths['broMonGro'] = 'yearly/g_broad_money_growth/';
        $wealths['saving'] = 'yearly/g_gross_saving_current_usd/';
        $wealths['savGdpRat'] = 'yearly/g_gross_saving_in_gdp/';
        $wealths['reserve'] = 'yearly/g_total_reserves_include_gold_current_usd/';
        $wealths['resNotAu'] = 'yearly/g_total_reserves_exclude_gold_current_usd/';
        $wealths['revGdpRat'] = 'yearly/g_revenue_in_gdp/';
        $wealths['expGdpRat'] = 'yearly/g_expense_in_gdp/';

        $year= 2018;
        $endYear = 2018;
        $len = $endYear-$year;
        $tag = 'tr';
        $data = array();
        for ($i=0; $i<$len; $i++){
            foreach($wealths as $key=>$val){
                $urlid = $val.$year;
                if($key === 'broadMoney'){
                    $transter = $this->get_data($urlid,$tag,'');
                }else{
                    $transter = $this->get_data($urlid,$tag);
                }
                $this->dataPush($data,$transter->all(),$key,count($data));
            }

            foreach($data as $k=>$v){
                $v['data_date'] = $year;
                country_wealth::create($v);
            }
            $year++;
            $data = array();
        }
    }

    function area(){
        set_time_limit(0);
        $address['area'] = 'yearly/g_area_surface/';
        $address['land'] = 'yearly/g_area_land/';
        $address['forest'] = 'yearly/g_area_forest/';
        $address['farming'] = 'yearly/g_area_agriculture/';
        $address['farLanRat'] = 'yearly/g_area_agriculture_land_perc/';
        $address['density'] = 'yearly/g_population_density/';

        $year = 1983;
        $endYear = 2018;
        $tag = 'tr';
        $len = $endYear-$year;
        $this->readWrite($len,$address,$year,$tag);
    }

    function propopu(){
$table=<<<'eof'
<table><tbody>
<tr><td>1</td><td>广东</td><td>10432万</td><td>&nbsp;11169万</td></tr><tr><td>2</td><td>山东</td><td>9579万</td><td>&nbsp;10005.83万</td></tr><tr><td>3</td><td>河南</td><td>9402万</td><td>&nbsp;9559.13万</td></tr><tr><td>4</td><td>四川</td><td>8041万</td><td>&nbsp;8302万</td></tr><tr><td>5</td><td>江苏</td><td>7866万</td><td>&nbsp;8029.3万</td></tr><tr><td>6</td><td>河北</td><td>7185万</td><td>&nbsp;7519.52万</td></tr><tr><td>7</td><td>湖南</td><td>6570万</td><td>&nbsp;6860.2万</td></tr><tr><td>8</td><td>安徽</td><td>5950万</td><td>&nbsp;6254.8万</td></tr><tr><td>9</td><td>湖北</td><td>5723万</td><td>&nbsp;5902万</td></tr><tr><td>10</td><td>浙江</td><td>5442万</td><td>&nbsp;5657万</td></tr><tr><td>11</td><td>广西</td><td>4602万</td><td>&nbsp;4885万</td></tr><tr><td>12</td><td>云南</td><td>4596万</td><td>&nbsp;4800.5万</td></tr><tr><td>13</td><td>江西</td><td>4456万</td><td>&nbsp;4622.1万</td></tr><tr><td>14</td><td>辽宁</td><td>4374万</td><td>&nbsp;4368.9万</td></tr><tr><td>15</td><td>福建</td><td>3689万</td><td>&nbsp;3911万</td></tr><tr><td>16</td><td>陕西</td><td>3732万</td><td>&nbsp;3835.44万</td></tr><tr><td>17</td><td>黑龙江</td><td>3831万</td><td>&nbsp;3788.7万</td></tr><tr><td>18</td><td>山西</td><td>3571万</td><td>&nbsp;3702.35万</td></tr><tr><td>19</td><td>贵州</td><td>3474万</td><td>&nbsp;3580万</td></tr><tr><td>20</td><td>重庆</td><td>2884万</td><td>&nbsp;3048.43万</td></tr><tr><td>21</td><td>吉林</td><td>2745万</td><td>&nbsp;2717.43万</td></tr><tr><td>22</td><td>甘肃</td><td>2557万</td><td>&nbsp;2625.71万</td></tr><tr><td>23</td><td>内蒙古</td><td>2470万</td><td>&nbsp;2528.6万</td></tr><tr><td>24</td><td>新疆</td><td>2181万</td><td>&nbsp;2444.67万</td></tr><tr><td>25</td><td>上海</td><td>2301万</td><td>&nbsp;2418.33万</td></tr><tr><td>26</td><td>台湾</td><td></td><td>&nbsp;2369万</td></tr><tr><td>27</td><td>北京</td><td>1961万</td><td>&nbsp;2170.7万</td></tr><tr><td>28</td><td>天津</td><td>1293万</td><td>&nbsp;1556.87万</td></tr><tr><td>29</td><td>海南</td><td>867万</td><td>&nbsp;925.76万</td></tr><tr><td>30</td><td>香港</td><td></td><td>&nbsp;743万</td></tr><tr><td>31</td><td>宁夏</td><td>630万</td><td>&nbsp;681.79万</td></tr><tr><td>32</td><td>青海</td><td>562万</td><td>&nbsp;598.38万</td></tr><tr><td>33</td><td>西藏</td><td>300万</td><td>&nbsp;337.15万</td></tr><tr><td>34</td><td>澳门</td><td></td><td>&nbsp;63.2万</td></tr></tbody></table>
eof;

        $table = QL\QueryList::html($table)->find('table');
            $data = $table->find('tr')->map(function ($row){
                return $row->find('td')->texts()->all();
            });
            $tanster = array();
            $n = 0;
            foreach($data as $value){
                $tanster['data_date'] = 2018;
                $tanster['province'] = $value[1];
                $tanster['population'] = bcmul(floatval(substr($value[3],2,-3)),10000);
                $n++;
                china::create($tanster);
            }
    }

    function country(){
        $str = <<<'EOD'
        https://baike.baidu.com/item/%E4%B8%AD%E8%8B%B1%E6%96%87%E5%9B%BD%E5%AE%B6%E5%AF%B9%E7%85%A7%E8%A1%A8/341490?fr=aladdin
EOD;
        $table = QL\QueryList::html($str)->find('tbody');
        $tableRows = $table->find('tr:gt(0)')->map(function($row){
            return $row->find('td')->texts()->all();
        });
        foreach($tableRows as $value){
            Country::create([
                'ChineseName' =>$value[2],
                'EnglishName' => $value[0],
                'EnglishNameSimple' => $value[1]
            ]);
        }
    }

    function sstock(){
        $html=<<<'EOD'
      http://data.eastmoney.com/cjsj/gpjytj.html  
EOD;

        $table = QL\QueryList::html($html)->find('tbody');
        $tableRows = $table->find('tr:gt(0)')->map(function($row){
            return $row->find('td')->texts()->all();
        });
        foreach($tableRows as $value){
            foreach ($value as &$item) {
                if($item === ""){
                    $item = null;
                }
            }
            history_stock::create([
                'StockExchange' =>'上海',
                'capital' =>$value[1],
                'TotalMoney' =>$value[3],
                'TradingMoney' =>$value[5],
                'TradingQuantity' =>$value[7],
                'MaxIndex' =>$value[9],
                'MinIndex' =>$value[11],
                'yearmonth' =>$value[0],
            ]);
            history_stock::create([
                'StockExchange' =>'深圳',
                'capital' =>$value[2],
                'TotalMoney' =>$value[4],
                'TradingMoney' =>$value[6],
                'TradingQuantity' =>$value[8],
                'MaxIndex' =>$value[10],
                'MinIndex' =>$value[12],
                'yearmonth' =>$value[0],
            ]);
        }
    }

    function updateCou(){
        $str=<<<'EOT'
        
EOT;
        $token = strtok($str, ",");

        $n = 0;
        while ($token != false)
        {
            echo "$token<br>";

            //Country::where('ChineseName',$token)->update(['state' => '大洋洲']);
            $token = strtok(",");
            $n++;
        }

        echo $n;
    }
}
