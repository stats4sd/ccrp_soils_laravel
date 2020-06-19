<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $contactus;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contactus)
    {
        //
        $this->contactus = $contactus;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("no-reply@stats4sd.org")
        ->subject('New contact form submission from the CCRP Soils Data Platform')
            ->markdown('emails.contactform');
    }
}
