<?php

namespace App\Listeners;

use App\Mail\NewVariableSpottedEmail;
use App\Events\NewDataVariableSpotted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdminAboutNewVariable
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
     * @param  object  $event
     * @return void
     */
    public function handle(NewDataVariableSpotted $event)
    {
        \Mail::to(config('app.admin_email'))->send(
            new NewVariableSpottedEmail($event->variableName, $event->dataMap)
        );
    }
}
