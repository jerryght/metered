<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCdTardingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cd_tarding',function(Blueprint $table){
            $table->bigIncrements('id',16)->comment('二手房交易信息,数据来源:https://cd.lianjia.com/chengjiao/, id值取源站编号');
            $table->string('type',30)->comment('房屋户型');
            $table->decimal('size',6,2)->comment('房屋面积');
            $table->decimal('unit_price',6,2)->comment('单价(元/㎡)');
            $table->decimal('total_price',6,2)->comment('总价格(万)');
            $table->year('data_date')->comment('成交时间');
            $table->integer('cd_neighbourhoods_id')->comment('楼盘id');
            $table->timestamps();
            $table->engine = 'InnoDB';

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cd_tarding');
    }
}
