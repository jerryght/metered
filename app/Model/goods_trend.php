<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class goods_trend extends Model
{
    protected $table = 'goods_trend';
    protected $guarded = ['id','created_at','updated_at'];
}
