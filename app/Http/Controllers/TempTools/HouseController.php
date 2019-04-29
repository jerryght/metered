<?php

namespace App\Http\Controllers\TempTools;

use App\Model\cd_neigh;
use App\Model\cd_neighbourhood;
use App\Model\cd_house;
use App\Model\cd_tarding;
use App\Model\house;
use http\QueryString;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use QL\QueryList;
use App\Http\Controllers\Acquest\BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class HouseController extends BaseController
{

    function neig(){
        $aurl = ['xiaoqu/longquanyi','xiaoqu/xindou','xiaoqu/tianfuxinqunanqu','xiaoqu/qingbaijiang','xiaoqu/doujiangyan','xiaoqu/pengzhou','xiaoqu/jianyang'];
        $aname = ['龙泉驿','新都','天府新区南区','青白江','都江堰','彭州','简阳'];
        $domain = 'https://cd.lianjia.com/';
        $index = 0;
        $model = new cd_neigh();
        foreach($aurl as $val){
            $url = $domain.$val.'/';
            $rules = [
                'id' => ['.xiaoquListItem','data-id'],
                'name' => ['.xiaoquListItem .title a','text'],
            ];
            $content = QueryList::get($url.'/pg1cro21');
            $page = $content->find('.house-lst-page-box')->attr('page-data');
            $total = (int)$content->find('.total span')->text();
            unset($content);
            $page = (int)substr($page,13,strpos($page,',')-13);
            $order = 'cro21';
            $attr = ['area'=>$aname[$index]];
            a:
            $this->item($page, $url, $rules, $model, $order, $attr);
            if($total > 900){
                $total = 0;
                $order = 'cro22';
                goto a;
            }
            $index++;
        }

    }

    function neigPlus(){
        $aurl = ['xiaoqu/qingbaijiang','xiaoqu/doujiangyan','xiaoqu/pengzhou','xiaoqu/jianyang'];
        $domain = 'https://cd.lianjia.com';
        $model = new cd_neigh();
        $n = 0;
        foreach($aurl as $val){
            $url = $domain.'/'.$val;
            $rules = [
                'road' =>['.position div:last a','href']
            ];
            $road = QueryList::get($url)->rules($rules)->query()->getData()->all();
            $rules = [
                'id' => ['.xiaoquListItem','data-id'],
                'name' => ['.xiaoquListItem .title a','text'],
                'area' => ['.district','text'],
            ];
            $file = 'storage/tansfer.txt';
            $urlCache = Storage::get($file);
            foreach($road as $item) {
                if(strstr($urlCache,$item['road'])){
                    continue;
                }
                $n++;
                Storage::append($file,$item['road']);
                Storage::disk('local')->put('storage/last_flas.txt',$val);
                $page = QueryList::get($domain.$item['road'])->find('.house-lst-page-box')->attr('page-data');
                $page = (int)substr($page,13,strpos($page,',')-13);
                $this->item($page, $domain.$item['road'], $rules, $model);
            }
        }
    }

    function neigDetail(){
        //$domain = 'https://cd.lianjia.com/xiaoqu/';
        //$id = cd_neigh::where(['year'=>0,'unit'=>0])->get();
        //foreach($id as $v){
            //$url = $domain.$v['id'];
            //$ql = QueryList::html(file_get_contents($url));
            $html = Storage::get('storage/html.txt');
            $ql = QueryList::html($html);
            //$info = $ql->find('xiaoquInfo')->html();
            //$ql = QueryList::html($info);
            $start_time = microtime(true);
            $year = $ql->find('.xiaoquInfo .xiaoquInfoContent:eq(0)')->text();
            $type = $ql->find('.xiaoquInfo .xiaoquInfoContent:eq(1)')->text();
            $expense = $ql->find('.xiaoquInfo .xiaoquInfoContent:eq(2)')->text();
            $unit = $ql->find('.xiaoquInfo .xiaoquInfoContent:eq(5)')->text();
            $household = $ql->find('.xiaoquInfo .xiaoquInfoContent:eq(6)')->text();
            $time_length= microtime(true)-$start_time;
            dd($time_length);
            //$v->year = (int)substr($year,0,4);
            //$v->type = $type;
            //$v->expense = (float)substr($expense,0,-10);
            //$v->unit = (int)substr($unit,0,-1);
            //$v->household = (int)substr($household,0,-1);
            //$v->save();
        //}
    }

    function houseDetail(){
        $domain = 'https://cd.lianjia.com/chengjiao/';
        $id = cd_house::where('type','')->get(['id']);
        foreach($id as $v){
            $url = $domain.$v['id'].'.html';
            $ql = QueryList::html(file_get_contents($url));
            $year = $ql->find('.xiaoquInfo .xiaoquInfoContent:eq(0)')->text();
            $type = $ql->find('.xiaoquInfo .xiaoquInfoContent:eq(1)')->text();
            $expense = $ql->find('.xiaoquInfo .xiaoquInfoContent:eq(2)')->text();
            $unit = $ql->find('.xiaoquInfo .xiaoquInfoContent:eq(5)')->text();
            $household = $ql->find('.xiaoquInfo .xiaoquInfoContent:eq(6)')->text();
            $data = [
                'year' => (int)substr($year,0,4),
                'type' => $type,
                'expense' => (float)substr($expense,0,-10),
                'unit' => (int)substr($unit,0,-1),
                'household' => (int)substr($household,0,-1)
            ];
            cd_neigh::where('id',$v['id'])->update($data);
        }
    }

    function tarding(){
        $domain = 'https://cd.lianjia.com/chengjiao/';
        $countFile = 'storage/count.txt';
        $count500 = 'storage/count500.txt';
        $c5 = (int)Storage::get($count500);
        Storage::put($count500,$c5+1);
        $offset = (int)Storage::get($countFile);
        $neigh = cd_neigh::offset($offset-$c5)->limit(13753-$offset)->get(['id','name'])->toArray();
        $model = new cd_house();
        foreach($neigh as $val){
            $html = file_get_contents($domain.'rs'.$val['name']);
            $ql = QueryList::html($html);
            $total = (int)trim($ql->find('.total span')->text());
            $page = $ql->find('.house-lst-page-box')->attr('page-data');
            $page = explode(',',$page);
            $page = substr($page[0],13);
            $offset++;
            Storage::disk('local')->put($countFile,$offset);
            if($total === 0) continue;
            $order = 'ddo31rs';

            $rules = [
                'id' => ['.listContent .title a','href'],
                'cd_neighs_id' => ['.listContent .title a','text']
            ];
            a:
            for($i=1; $i<=$page; $i++){
                $url = $domain.'pg'.$i.$order.$val['name'];
                $data = QueryList::get($url)->rules($rules)->query()->getData();
                $data = $data->all();
                foreach ($data as &$v){
                    $v['id'] = substr($v['id'],strrpos($v['id'],'/')+1,-5);
                    if($val['name'] !== $v['cd_neighs_id']){
                        $name = explode(' ', $v['cd_neighs_id']);
                        $ne = cd_neigh::where('name',$name[0])->first(['id']);
                        $v['cd_neighs_id'] = $ne ? $ne->id : 0;
                    }else{
                        $v['cd_neighs_id'] = $val['id'];
                    }
                }
                $this->save($model, $data);
            }
            if($total > 900){
                $total = 0;
                $order = 'ddo32rs';
                goto a;
            }
        }
    }


    function sell(){
        $domain = 'https://cd.lianjia.com/ershoufang/';
        $file = 'storage/tansfer.txt';
        $offset = (int)Storage::get($file);
        $idList = cd_neigh::offset($offset)->limit(13753-$offset)->get(['name']);
        ini_set('default_socket_timeout', 1);
        foreach($idList as $val){
            $url = $domain.'rs'.$val['name'];
            $html = file_get_contents($url);
            $ql = QueryList::html($html);
            $total = (int)trim($ql->find('.total>span')->text());
            $offset++;
            if($total === 0){
                Storage::put($file,$offset);
                continue;
            }
            $rules = [
                'id' => ['.bigImgList>.item','data-houseid'],
            ];
            $page = $ql->find('.house-lst-page-box')->attr('page-data');
            $page = explode(',',$page);
            $page = substr($page[0],13);
            for ($i=1; $i<=$page; $i++){
                $html = file_get_contents($domain.'pg'.$i.'rs'.$val['name']);
                $ql = QueryList::html($html);
                $id = $ql->rules($rules)->query()->getData()->all();
                foreach($id as $v){
                    cd_tarding::firstOrCreate([
                        'id' => $v['id']
                    ]);
                }
            }
            Storage::put($file,$offset);
        }
        die('success');
    }

    function item($page, $url, $rules, $model, $order='', $attr=[]){
        for($i=1; $i<=$page; $i++){
            Storage::put('storage/last_flag.txt',$url.'pg'.$i.$order);
            $data = QueryList::get($url.'pg'.$i.$order)->rules($rules)->query()->getData();
            $this->save($model, $data->all(), $attr);
        }
    }

    function toInt($string,$len){
        return (int)str_replace(',','',substr($string,0,$len)) ?: '';
    }

    function ajax(){
        return view('TempTools\ajax');
    }
}
