<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class goods_info extends Model
{
    protected $table = 'goods_info';
    protected $guarded = ['id','created_at','updated_at'];
}
