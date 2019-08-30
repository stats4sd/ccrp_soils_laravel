<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RedeployFormToKobotools implements ShouldQueue
{

    private $formId;
    private $projectId;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($formId, $projectId)
    {
        $this->formId = $formId;
        $this->projectId = $projectId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $proj_xls = DB::table('project_xlsform')->where('project_id', $this->projectId)->where('xlsform_id', $this->formId)->get();
        $uid = $proj_xls[0]->form_kobo_id_string;
        $client = new Client();


        $id = config('services.kobo.id');
        $password = config('services.kobo.password');

        $get = [
                'auth' => [$id, $password],
                'headers' => [
                    'Accept' => 'application/json'
                    ]
                ];
        $resp = $client->request('GET', 'https://kf.kobotoolbox.org/assets/'.$uid.'/', $get);
        $response = json_decode($resp->getBody());
        Log::info($response);
        Log::info($response->deployed_version_id);
        //return $response;
    }
}
