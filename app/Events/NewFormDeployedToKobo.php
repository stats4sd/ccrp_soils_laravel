<?php

namespace App\Events;

use App\Models\User;
use App\Models\Xlsform;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewFormDeployedToKobo implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $xlsform;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Xlsform $xlsform)
    {
        //
        $this->user = $user;
        $this->xlsform = $xlsform;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel("App.User.{$this->user->id}");
    }
}
