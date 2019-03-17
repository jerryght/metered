<?php
/**
 * Created by PhpStorm.
 * User: liaoliao
 * Date: 2018/10/20
 * Time: 22:30
 */

namespace app\Http\Controllers\Acquest;

use QL;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;

class commoditiesController extends Controller{

    function Synt(){
        $host = 'http://www.sge.com.cn/';
        $spider = new QL\QueryList();
        $html = file_get_contents($host.'sjzx/mrhqsj');
        $rules = array(
            ''
        );
        $result = $spider->html($html)->rules($rules)->query()->getData();
        $arr = $result->all();
    }
}
