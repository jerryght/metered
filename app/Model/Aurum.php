<?php

namespace App\Model;

use App\Scopes\Aurumc;
use Illuminate\Database\Eloquent\Model;

class Aurum extends Model
{
    //public $timestamps = false;
    //protected $fillable = ['market','price','tradingDay','amounts','weight'];
    protected $guarded = ['id','create','market'];
    const CREATED_AT = 'created';
    const UPDATED_AT = null;
/*
    protected static function boot(){
        parent::boot();
        static::addGlobalScope(new Aurumc());
    }
*/
}
