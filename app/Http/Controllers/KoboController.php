<?php

namespace App\Http\Controllers;

use App\Jobs\ImportFormToKobotools;
use App\Models\Xlsform;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KoboController extends Controller
{

    /**
     * Function to create a new instance of the requested form on Kobotoolbox, and then share the new form with the requested project.
     * @param  Request $request A POST request including:
     *                          - formId;
     *                          - projectId;
     * @return array           An array containing the response data:
     *                            - HTTP response code from Kobotools request;
     *                            - The UID of the form on Kobotools;
     */
    public function publish(Request $request)
    {   
        $formId = $request->formId;
        $projectId = $request->projectId;

        // //$form->form_id is actually the file path!
        // $xlsFile = Storage::disk('uploads')->path($form->path_file);


        // // setup Guzzle Client info
        // $client = new Client();
       
        // $id = config('services.kobo.id');
        // $password = config('services.kobo.password');

        // // prepare payload for creating new form

        // $post = [
        //     'auth' => [$id, $password],
        //     'headers' => [
        //         'Accept' => 'application/json'
        //     ],
        //     'multipart' => [
        //         [
        //             'name' => 'library',
        //             'contents' => 'true',
        //         ],
        //         [
        //             'name' => 'file',
        //             'contents' => file_get_contents($xlsFile),
        //             'filename' => 'text.xlsx',
        //         ],
        //         [
        //             'name' => 'name',
        //             'contents' => 'Testing Form For Kobo API 2345 ',
        //         ],
        //         [
        //             'name' => 'settings',
        //             'contents' => '{"description":"hello from testing helloooooooo"}',
        //         ],
        //         [
        //             'name' => 'asset_type',
        //             'contents' => 'survey',
        //         ],
        //     ]
        // ];

        dispatch(new ImportFormToKobotools($formId, $projectId));
       
    

        return   $response = [
                    'status' => 'imported',
            ];     

    }


     public function deploy($uid)
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


         $res = $client->request('GET', 'https://kf.kobotoolbox.org/imports/ijJQDQGTq6fJ5Tthshm93n/', $post) ;
         

      
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
                    'name' => 'active',
                    'contents' => 'true',
                ]
               
            ]
                
        ];


        // preprare response array;
        $response = [];

        try {
            // Send the request to Kobotoolbox
            $res = $client->request('POST', 'https://kf.kobotoolbox.org/assets/'.$uid.'/deployment/', $post);
          
            $response = [
                    'status' => $res->getStatusCode(),
            ];

            //POST request to imports returns 201 on success.
            if($response['status'] == 200) {
              
               // $response['data'] = json_decode($res->getBody());

                //save uid
                $project->xls_forms->updateExistingPivot($formId, ['form_kobo_id' => $response['data']['uid']]);
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
            return $response;
        }

    }

}
