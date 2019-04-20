<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class house extends Model
{
    protected $guarded = ['id','created_at'];
    const UPDATED_AT = null;
}
