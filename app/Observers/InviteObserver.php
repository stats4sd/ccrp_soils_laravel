<?php

namespace App\Observers;

use App\Models\Invite;
use App\Mail\InviteMember;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class InviteObserver
{
    /**
     * Handle the invite "created" event.
     *
     * @param  \App\Models\Invite  $invite
     * @return void
     */
    public function created(Invite $invite)
    {
        Mail::to($invite->email)->send(new InviteMember($invite));
    }

    /**
     * Handle the invite "updated" event.
     *
     * @param  \App\Models\Invite  $invite
     * @return void
     */
    public function updated(Invite $invite)
    {
        //
    }

    /**
     * Handle the invite "deleted" event.
     *
     * @param  \App\Models\Invite  $invite
     * @return void
     */
    public function deleted(Invite $invite)
    {
        //
    }

    /**
     * Handle the invite "restored" event.
     *
     * @param  \App\Models\Invite  $invite
     * @return void
     */
    public function restored(Invite $invite)
    {
        //
    }

    /**
     * Handle the invite "force deleted" event.
     *
     * @param  \App\Models\Invite  $invite
     * @return void
     */
    public function forceDeleted(Invite $invite)
    {
        //
    }
}
