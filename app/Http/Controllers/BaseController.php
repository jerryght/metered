<?php

namespace App\Http\Controllers;

use App\Model\Country;
class BaseController extends Controller
{
    function ToArray($stdClass,$attribute){
        $arr = array();
        foreach ($stdClass as $key) {
                $arr[] = $key->$attribute;
        }
        return $arr;
    }

    function EnglishName(&$ChineseName){
        foreach($ChineseName as &$value){
             $value['country'] = Country::where('ChineseName',$value['country'])->get(['EnglishName'])->toArray()[0]['EnglishName'];
        }
    }

    function forsubstr(&$strgroup,$column,$len){
        foreach($strgroup as &$value){
             if(strlen($value[$column])>$len){
                 $value[$column] = substr($value[$column],0,$len-3).'...';
             }
        }
    }
}
