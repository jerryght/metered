<?php

namespace App\Http\Controllers\DataAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\china;
class ChinaController extends Controller
{
    function population()
    {
        //header("Access-Control-Allow-Origin:*");
        $data = china::get(['province','population']);
        $tanster = array();
        $n = 0;
        foreach ($data as $value)
        {
            $tanster[$n]['name'] = $value->province;
            $tanster[$n]['value'] = bcdiv($value->population,10000,0);
            $n++;
        }
        echo json_encode($tanster);
    }
}
