<?php

namespace App\Events;

use App\Models\DataMap;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewDataVariableSpotted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $variableName;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(String $variableName, DataMap $dataMap)
    {
        //
        $this->variableName = $variableName;
        $this->dataMap = $dataMap;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel("App.User.{$this->user->id}");
    }
}
