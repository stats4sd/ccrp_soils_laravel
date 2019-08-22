<?php

namespace App\Jobs;

use App\Models\Project;
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
            $new_uid = $response->messages->created[0]->uid;

            $get = [
                'auth' => [$id, $password],
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'multipart' => [
                    [
                        'name' => 'active',
                        'contents' => 'true',
                    ]
                ]

            ];
           
            $resp = $client->request('POST', 'https://kf.kobotoolbox.org/assets/'.$new_uid.'/deployment/', $get);
            //Rename form
            $this->renameForm($new_uid);
            
            //save uid
            // $project = Project::find($this->projectId);
            // Log::info($project->xls_forms);
           // $project->xls_forms->updateExistingPivot(['form_kobo_id_string' => $new_uid]);


        } else {
            $this->handle();

        }

        //return $response;
    }

    public function renameForm($uid)
    {

        $client = new Client();
        $form = Xlsform::find($this->formId);

        $id = config('services.kobo.id');
        $password = config('services.kobo.password');

        $get = [
                'auth' => [$id, $password],
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'multipart' => [
                    [
                        'name' => 'name',
                        'contents' => $form->form_title,
                    ],
                    [
                        'name' => 'settings',
                        'contents' => '{"description":"'.$form->description.'"}',
                    ],
                    [
                        'name' => 'asset_type',
                        'contents' => 'survey',
                    ]

                ]

            ];
        $resp = $client->request('PATCH', 'https://kf.kobotoolbox.org/assets/'.$uid.'/', $get);
        //Log::info($resp->getBody());
        $this->updateProjForm($uid);

      

        // $project = Project::find($projectId);
            
        //    $project->xls_forms->updateExistingPivot(['form_kobo_id_string' => $uid]);

        // return $response;
    }

    public function updateProjForm($uid)
    {
        $this->redeploy(); 
        // update form uid into project_xlsform
        DB::table('project_xlsform')->where('project_id', $this->projectId)->where('xlsform_id', $this->formId)->update(['form_kobo_id_string'=>$uid]);
        // update the status of the form
        DB::table('project_xlsform')->where('project_id', $this->projectId)->where('xlsform_id', $this->formId)->update(['deployed'=>'1']);
        

    }

     public function redeploy()
    {

        $client = new Client();
        $form = Xlsform::find($this->formId);

        $id = config('services.kobo.id');
        $password = config('services.kobo.password');

        $get = [
                'auth' => [$id, $password],
                'headers' => [
                    'Accept' => 'application/json'
                    ]
                ];
        $resp = $client->request('GET', 'https://kf.kobotoolbox.org/assets/'.'av772yQz4hCVQUdGD84cSp'.'/', $get);
        $response = json_decode($resp->getBody());
        Log::info($response);
        

      

        // $project = Project::find($projectId);
            
        //    $project->xls_forms->updateExistingPivot(['form_kobo_id_string' => $uid]);

        // return $response;
    }




}
