<?php
/**
 * Created by PhpStorm.
 * User: liaoliao
 * Date: 2019/2/14
 * Time: 22:30
 */
namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Aurumc implements Scope{
    /**类名要与文件名相同
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        return $builder->where('id', '<', 30);
    }
}
