<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Invite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

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

    //    //If Kobousername is updated, check it's real.
    //     if($user->isDirty("kobo_id")) {

    //         $testForm = config('services.kobo.test_form');
    //         $endPoint = config('services.kobo.endpoint_v2');

    //         $payload = [
    //             'permission' => $endPoint . '/permissions/add_submissions/',
    //             'user' => $endPoint . '/users/' . $this->username . '/',
    //         ];

    //         $response = Http::withBasicAuth(config('services.kobo.username'), config('services.kobo.password'))
    //             ->withHeaders(['Accept' => 'application/json'])
    //             ->post($endPoint . '/assets/' . $testForm . '/permission-assignments/', $payload)
    //             ->json();

    //         if($response->successful()) {
    //             return true;
    //         }

    //         if($response->failed()) {
    //             return false;
    //         }

        //}

    }

}
