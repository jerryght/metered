<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class exrate_cny extends Model
{
    protected $table = 'exrate_cny';
    protected $guarded = ['id','created_at'];
    const UPDATED_AT = null;
}
