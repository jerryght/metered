<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $table = 'house';
    protected $guarded = ['id'];
    const UPDATED_AT = null;
}
