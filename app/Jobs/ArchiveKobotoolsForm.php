<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ArchiveKobotoolsForm implements ShouldQueue
{
    private $uid;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($uid)
    {
        //
        $this->uid = $uid;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = KoboHelper::getClient();

        $deployRes = $client->request("POST", "api/v2/assets/$this->uid/deployment/", [
            "form_params" => [
                "active" => true,
            ],
        ]);
    }
}
