<?php

namespace App\Http\Controllers\TempTools;

use App\Model\House;
use QL\QueryList;
use App\Http\Controllers\Acquest\BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class HouseController extends BaseController
{
    function index()
    {
        $countFile = 'storage/count.txt';
        $count= Storage::get($countFile);
        if($count === "")
        {
            $page = 1;
        }else{
            $page = $count;
        }
        $rules = [
             ['.rank-table>ul>li>span','text'],
        ];
        $tansfer = array();
        for(; $page<2731; $page++) {
            $url = 'http://cd.jiwu.com/jilu/list-page'.$page.'.html';
            $data = QueryList::get($url)->rules($rules)->query()->getData()->all();
            $i = 0;
            foreach ($data as $key => $val)
            {
                $index = $key % 6;
                switch ($index) {
                    case 0:
                        $i++;
                        $tansfer[$i]['neighbourhood'] = $val[0] ?: '';
                        break;
                    case 1:
                        $tansfer[$i]['mark'] = $val[0] ?: '';
                        break;
                    case 2:
                        $tansfer[$i]['area'] = $this->toInt($val[0],-6);
                        break;
                    case 3:
                        $tansfer[$i]['data_date'] = $val[0] ?: '';
                        break;
                    case 4:
                        $tansfer[$i]['unit_price'] = $this->toInt($val[0],-3);
                        break;
                    case 5:
                        $tansfer[$i]['total_price'] = $this->toInt($val[0],-3);
                        break;
                }
            }
            foreach ($tansfer as $key=>$value)
            {
                if($value['mark'] === '房源信息')
                {
                    continue;
                }
                DB::transaction(function () use ($value) {
                    House::create($value);
                }, 3);
            }
            Storage::disk('local')->put($countFile, $page);
        }
    }

    function toInt($string,$len){
 return (int)str_replace(',','',substr($string,0,$len)) ?: '';
    }
}