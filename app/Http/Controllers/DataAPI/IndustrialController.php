<?php

namespace App\Http\Controllers\DataAPI;

use App\Model\industrial;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class IndustrialController extends BaseController
{
    function index()
    {
        $data = industrial::orderBy('id','desc')->get(['data_date','total']);
        $date = $this->toArray($data,'data_date');
        $value = $this->toArray($data,'total');
        echo json_encode(array('date' => $date, 'value' =>$value));
    }
}
