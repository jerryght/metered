<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countrys';
    protected $guarded = ['id','created_at','updated_at'];
}
