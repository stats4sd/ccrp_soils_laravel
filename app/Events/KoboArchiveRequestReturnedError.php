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

class KoboArchiveRequestReturnedError implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $form;
    public $errorType;
    public $errorMessage;

    /**
     * Create a new event instance.
     * @param User $user
     * @param Xlsform|Projectxlsform $form
     * @return void
     */
    public function __construct(User $user, $form, $errorType, $errorMessage)
    {
        //
        $this->user = $user;
        $this->form = $form;
        $this->errorType = $errorType;
        $this->errorMessage = $errorMessage;
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
