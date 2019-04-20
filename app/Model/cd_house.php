<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class cd_house extends Model
{
    protected $guarded = ['created_at','updated_at'];
    public $incrementing = false;
}
