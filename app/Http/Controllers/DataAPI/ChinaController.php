<?php

namespace App\Http\Controllers\DataAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\china;
class ChinaController extends Controller
{
    function population()
    {
        $data = china::get(['province','population','simple']);
        $tanster = array();
        $n = 0;
        foreach ($data as $value)
        {
            $tanster[$n]['name'] = $value->province;
            $tanster[$n]['value'] = (int)bcdiv($value->population,10000,0);
            $tanster[$n]['simple'] = $value->simple;
            $n++;
        }
        shuffle($tanster);
        echo json_encode($tanster);
    }
}
