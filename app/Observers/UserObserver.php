<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Invite;
use Illuminate\Support\Str;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {

        // check for any invites sent to the new user's email address...
        $invites = Invite::where('email', '=', $user->email)->get();

        // for each invite:
        foreach($invites as $invite) {
            $user->projects()->syncWithoutDetaching($invite->project->id);

            $invite->confirm();
        }

    }

    public function saving (User $user)
    {
       $user->slug = Str::slug($user->email);
    }

}
