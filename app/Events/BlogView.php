<?php

namespace App\Events;

use App\Events\Event;
use App\Model\article_description;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BlogView extends Event
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $article_description;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(article_description $article_description)
    {
        $this->article_description = $article_description;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
