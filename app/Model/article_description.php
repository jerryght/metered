<?php

namespace App\Model;

use App\Model\BaseModel;

class article_description extends BaseModel
{
    public $primaryKey = 'article_id';
    public $timestamps = false;
    protected $guarded = ['article_id'];
}
