<?php

namespace App\Mail;

use App\Models\DataMap;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewVariableSpottedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $variableName;
    public $dataMap;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $variableName, DataMap $dataMap)
    {
        //
        $this->variableName = $variableName;
        $this->dataMap = $dataMap;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("no-reply@stats4sd.org")
        ->subject('CCRP Soils Platform: New Variable Spotted!!')
            ->markdown('emails.new_variable');
    }
}
