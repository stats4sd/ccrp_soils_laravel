<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InviteMember extends Mailable
{
    use Queueable, SerializesModels;

    public $invite;

        /**
         * Create a new message instance.
         *
         * @return void
         */
        public function __construct($invite)
        {
            $this->invite = $invite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("no-reply@stats4sd.org")
        ->subject('CCRP Soils Platform: Invitation to Register to ' . $this->invite->project->name )
        ->markdown('emails.invite');
    }
}
