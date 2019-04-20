<?php

namespace App\Http\Controllers\TempTools;

use App\Model\article_description;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Event;
use App\Events\BlogView;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function showPost($article)
    {
        DB::connection()->enableQueryLog();
        $obj = article_description::find($article);
        $log = DB::getQueryLog();
        $r = Event(new BlogView($obj));
    }
}
