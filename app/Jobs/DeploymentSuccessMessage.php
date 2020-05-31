<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Xlsform;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NewFormDeployedToKobo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DeploymentSuccessMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $form;
    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Xlsform $form, User $user)
    {
        //
        $this->form = $form;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // emit Laravel event
        event(new NewFormDeployedToKobo($this->user, $this->form));

    }
}
