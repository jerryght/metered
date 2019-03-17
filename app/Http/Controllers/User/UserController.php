<?php
/**
 * Created by PhpStorm.
 * User: liaoliao
 * Date: 2018/8/25
 * Time: 22:19
 */
namespace App\Http\Controllers\User;

use Illuminate\Routing\Controller;

class UserController extends Controller{
    function login(){
        return view('User\login');
    }
}