<?php

namespace App\Jobs;

use App\Models\Project;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Relations\Concerns\updateExistingPivot;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class DeployKobotoolsForm implements ShouldQueue
{
    private $uid;
    private $projectId;
    private $formId;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($uid, $projectId, $formId)
    {
        
        $this->uid = $uid;
        $this->projectId = $projectId;
        $this->formId = $formId;
         
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new Client();
       
        $id = config('services.kobo.id');
        $password = config('services.kobo.password');
         $post = [
            'auth' => [$id, $password],
            'headers' => [
                'Accept' => 'application/json'
            ]
        ];

        
        $res = $client->request('GET', 'https://kf.kobotoolbox.org/imports/'.$this->uid, $post);
        $response = json_decode($res->getBody());





        if($response->status=="complete")
        {
            //Log::info(json_encode($response->messages->created[0]->uid));
            //Rename form
            // $resp_rename = $client->request('PATCH', 'https://kf.kobotoolbox.org/assets/'.$response->messages->created[0]->uid, $post);
            // Log::info(json_decode($resp_rename->getBody()));
            $get = [
                'auth' => [$id, $password],
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'multipart' => [
                    [
                        'name' => 'name',
                        'contents' => 'CCRP',
                    ]                  
                ]
                    
            ];
             $resp = $client->request('POST', 'https://kf.kobotoolbox.org/assets/'.$response->messages->created[0]->uid.'/deployment/', $get);
            //save uid
            // $project = Project::find($this->projectId);
            // Log::info($project->xls_forms);
            //$project->xls_forms->updateExistingPivot(['form_kobo_id_string' => $response->messages->created[0]->uid]);

        } else {
            Log::error("Deploying new form to Kobotoolbox failed with error " . json_encode($response['status']) . ".");
            $response['error'] = "Request failed with HTTP error " . json_encode($response['status']) . ". Please contact your administrator.";

        }


        return $response;
    }
}
