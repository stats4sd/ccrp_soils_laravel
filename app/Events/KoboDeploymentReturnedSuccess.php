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

class KoboDeploymentReturnedSuccess implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $form;

    /**
     * Create a new event instance.
     * @param User $user
     * @param Xlsform|ProjectXlsform $form
     * @return void
     */
    public function __construct(User $user, $form)
    {
        $this->user = $user;
        $this->form = $form;
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
