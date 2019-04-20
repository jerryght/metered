<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class cd_neigh extends Model
{
    protected $guarded = ['created_at', 'updated_at'];
    protected $primaryKey = 'bigint';
    public $incrementing = false;
}
