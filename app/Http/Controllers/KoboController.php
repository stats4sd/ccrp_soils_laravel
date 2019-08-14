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
       

        // preprare response array;
        $response = [];

      

    }

}
