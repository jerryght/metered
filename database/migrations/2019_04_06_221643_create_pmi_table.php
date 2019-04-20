<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cd_neighbourhoods', function (Blueprint $table) {
            $table->increments('id')->comment('成都楼盘信息,数据来源:https://cd.fang.anjuke.com/loupan/baojia/,id取源站内编号');
            $table->string('name',30)->comment('楼盘名称');
            $table->enum('area',['成华','双流','高新','新都','温江','龙泉驿','郫都','锦江','武侯','青羊','金牛','高新西区','都江堰','青白江','新津','成都周边','大邑','蒲江','金堂','彭州','邛崃','崇州','天府新区'])->comment('楼盘所在区域');
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
        Schema::dropIfExists('pmi');
    }
}
