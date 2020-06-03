<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class KoboUploadReturnedError implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $form;
    public $errorType;
    public $errorMessage;


    /**
     * Create a new event instance
     *
     * @param User $user
     * @param Xlsform|ProjectXlsform $form
     * @param String $errorType
     * @param String $errorMessage
     */
    public function __construct($user, $form, $errorType, $errorMessage)
    {
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
        return new PrivateChannel("App.User.{$this->user->id}");
    }
}