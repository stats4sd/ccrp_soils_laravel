<?php

namespace App\Jobs\Projects;

use App\Models\User;
use App\Models\ProjectXlsform;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\KoboDeploymentReturnedSuccess;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DeploymentSuccessMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $form;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, ProjectXlsform $form)
    {
        $this->user = $user;
        $this->form = $form;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // emit Laravel event
        event(new KoboDeploymentReturnedSuccess($this->user, $this->form));

    }
}
