<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InviteMember extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->info = $data;
       //dd($data);
        //creator_id
        //no-reply@stats4sd.org
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->info['email'])->subject('[CCRP Soils Data Platform] You have an invitation to the group: '.$this->info['name'])->view('invite_member_email')->with('info', $this->info);
    }
}
