<?php
/**
 * Created by PhpStorm.
 * User: liaoliao
 * Date: 2019/2/2
 * Time: 11:50
 */

namespace app\Http\Controllers\DataAPI;

use App\Model\country_population;
use App\Model\country_wealth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\shanghaiau;
class PopulationController extends Controller
{
    function ToArray($stdClass,$attribute,$unit=false)
    {
        $arr = array();
        foreach ($stdClass as $key)
        {
            if($unit)
            {
                $arr[] = bcdiv($key->$attribute,'100000000',2);
            }else{
                $arr[] = $key->$attribute;
            }
        }
        return $arr;
    }

    function growth()
    {
        /*DB::connection()->enableQueryLog();*/
        function query($country)
        {
            return DB::select("select `increase` from `country_populations` where `country`='$country'");
        }
        $year = DB::select("select distinct(year(`data_date`)) as `year` from `country_populations`");
        $years = $this->ToArray($year,'data_date');

        $who = array('中国',  '印度','美国', '印尼','巴西');
        $len = count($year);
        $growth = array();
        $country = array();
        $n = 0;
        foreach($who as $every)
        {
            //$temp = query($every);
            $temp = $this->ToArray(query($every),'increase');
            /*确保$temp与$country对应键值的数据，为同一个国家。
              $growth的格式用于前端数据渲染
            */
            if(count($temp) === $len)
            {
                $growth[$n]['data'] = $temp;
                $growth[$n]['type'] = 'bar';
                $growth[$n]['smooth'] = true;
                /*$growth[$n]['areaStyle'] = [];*/
                $growth[$n]['name'] = $every;
                $country[] = $every;
                $n++;
            }
        }
        echo json_encode(array('growth'=>$growth, 'years'=>$years, 'country'=>$country));
    }

    function incease()
    {
        $who = array('美国','中国','日本');
        $data = array();
        $i = 0;
        foreach($who as $value)
        {
            $transter = country_wealth::where('country','=',$value)->get(['gdpUSD'])->all();
            $data[$i]['count'] = $this->ToArray($transter,'gdpUSD',100000000);
            $data[$i]['country'] = $value;
            $i++;
        }
        $year = country_wealth::distinct()->get(['data_date']);
        echo json_encode(array('years'=>$this->ToArray($year,'data_date'),'country'=>$who,'count'=>$data));
    }
    function count()
    {
        //country_population::where(DB::raw(1), 1)->update(['created_at' => date('Y-m-d H:i:s')]);全部更新
        $who = array('美国','中国');
        $EnglishName = array('United States','China');
        $data = array();
        $i = 0;
        foreach($who as $value){
            $transter = country_wealth::where('country','=',$value)->get(['gdpUSD','gdpCapUSD'])->all();
            $data[$i]['count'] = $this->ToArray($transter,'gdpUSD',100000000);
            $data[$i]['population'] = $this->ToArray($transter,'gdpCapUSD');
            $data[$i]['country'] = $EnglishName[$i];
            $i++;
        }
        $year = country_wealth::distinct()->get(['data_date']);
        echo json_encode(array('years'=>$this->ToArray($year,'data_date'),'country'=>$EnglishName,'count'=>$data));
    }
}