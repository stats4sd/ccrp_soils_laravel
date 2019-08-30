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

class ShareFormToKobotools implements ShouldQueue
{
    private $projectId;
    private $formId;
    private $kobo_id;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($formId, $projectId, $kobo_id)
    {
        $this->formId = $formId;
        $this->projectId = $projectId;
        $this->kobo_id = $kobo_id;

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
    
        // setup Guzzle Client info
        $client = new Client();
       
        $id = config('services.kobo.id');
 
        $password = config('services.kobo.password');

        // prepare payload for creating new form

        $post = [
            'auth' => [$id, $password],
            'headers' => [
                'Accept' => 'application/json'
            ],
            'multipart' => [
                [
                    'name' => 'content_object',
                    'contents' => "https://kf.kobotoolbox.org/assets/".$uid."/",
                ],               
                [
                    'name' => 'permission',
                    'contents' => 'change_asset',
                ],
                //problem with passing kobo_id
                [
                    'name' => 'user',
                    'contents' => 'https://kf.kobotoolbox.org/users/'.$this->kobo_id.'/',
                ]
               
            ]
        ];

         // preprare response array;
        
        $response = [];

        try {
            // Send the request to Kobotoolbox
            $res = $client->request('POST', "https://kf.kobotoolbox.org/permissions/", $post);
            log::info(json_decode($res->getBody()));

            $status = $res->getStatusCode();
         
            
            $response = [
                    'status' => $res->getStatusCode(),
            ];

            //POST request to imports returns 201 on success.
            if($response['status'] == 201) {

                $response['data'] = json_decode($res->getBody());
                $response = [
                        'uid' => $response['data']['uid'],
                    ];        
            }


            else {
                Log::error("Posting new form to Kobotoolbox failed with error " . $response['status'] . ".");
                $response['error'] = "Request failed with HTTP error " . $response['status'] . ". Please contact your administrator.";
            }
        }

        catch(\Exception $e) {
            //log error to debugging log
            Log::error($e->getMessage());

            //return error to user
            $response['error'] = $e->getMessage();
        }

        finally {
            //Deploy
         
           
            
        }
    
    }
}
