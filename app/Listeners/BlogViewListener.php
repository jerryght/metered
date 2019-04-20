<?php

namespace App\Listeners;

use App\Events\BlogView;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BlogViewListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BlogView  $event
     * @return void
     */
    public function handle(BlogView $event)
    {
        $event->article_description->viewed = $event->article_description->viewed+1;
        $event->article_description->save();
    }


}
