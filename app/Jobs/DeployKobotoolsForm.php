<?php

namespace App\Jobs;

use App\Helpers\KoboHelper;
use App\Jobs\ShareFormToKobotools;
use App\Models\Project;
use App\Models\Projectxlsform;
use App\Models\Xlsform;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Relations\Concerns\updateExistingPivot;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Deploys a Kobotools form.
 */
class DeployKobotoolsForm implements ShouldQueue
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

        //Get asset to check if deploy or REdeploy is needed

        $res = $client->request('GET', "api/v2/assets/$this->uid");
        $asset = json_decode($res->getBody());

        if($asset->has_deployment) {
            // RE-deploy form

            $deployRes = $client->request("PATCH", "api/v2/assets/$this->uid/deployment/", [
                "form_params" => [
                    "version_id" => $asset->version_id,
                ],
            ]);

        }

        else {
            // deploy form for the first time

            $deployRes = $client->request("POST", "api/v2/assets/$this->uid/deployment/", [
                "form_params" => [
                    "active" => true,
                ],
            ]);

        }


    }

}
