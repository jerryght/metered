<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class currency extends Model
{
    protected $table = 'currency';
    protected $guarded = ['id','created_at','updated_at'];
}
