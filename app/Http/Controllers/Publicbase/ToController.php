<?php
/**
 * Created by PhpStorm.
 * User: liaoliao
 * Date: 2019/2/13
 * Time: 20:33
 */

namespace app\Http\Controllers\Publicbase;

class To {
    function arr($object,$key){
        $len = count($object);
        $arr = array();
        for($i=0; $i<$len; $i++){
            $arr[] = $object[$i]->$key;
        }
        return $arr;
    }
}
