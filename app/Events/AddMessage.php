<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AddMessage
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reply;

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    public function __construct($reply)
  	{
    	$this->reply = $reply;
  	}
}
