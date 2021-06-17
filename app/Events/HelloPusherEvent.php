<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Event;

/**
 * Just implement the ShouldBroadcast interface and Laravel will automatically
 * send it to Pusher once we fire it
 **/
class HelloPusherEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * Only (!) Public members will be serialized to JSON and sent to Pusher
     **/
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return channel
     */
    public function broadcastOn(): Channel
    {
        return new channel('my-channel');
    }
}
