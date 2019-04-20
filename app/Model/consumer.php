<?php

namespace App\Model;

use App\Model\BaseModel;

class consumer extends BaseModel
{
    public $timestamps = false;
    protected $guarded = ['id'];
}
