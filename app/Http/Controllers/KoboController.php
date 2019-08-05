<?php

namespace App\Http\Controllers;

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
    public function publish (Request $request)
    {

        $formId = $request->formId;
        $projectId = $request->projectId;

        $form = Xlsform::find($formId);

        //$form->form_id is actually the file path!
        $xlsFile = Storage::disk('uploads')->path($form->form_id);


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
                    'name' => 'library',
                    'contents' => 'false',
                ],
                [
                    'name' => 'file',
                    'contents' => file_get_contents($xlsFile),
                    'filename' => 'text.xlsx',
                ],
                [
                    'name' => 'name',
                    'contents' => 'Testing Form For Kobo API 2345 ',
                ],
                [
                    'name' => 'settings',
                    'contents' => '{"description":"hello from testing helloooooooo"}',
                ],
                [
                    'name' => 'asset_type',
                    'contents' => 'survey',
                ],
            ]
        ];

        // preprare response array;
        $response = [];

        try {
            // Send the request to Kobotoolbox
            $res = $client->request('POST', 'https://kf.kobotoolbox.org/imports/', $post);

            $response = [
                    'status' => $res->getStatusCode(),
            ];

            //POST request to imports returns 201 on success.
            if($response['status'] == 201) {
                $response['data'] = json_decode($res->getBody());

                //save uid
                $project->forms()->updateExistingPivot($formId, ['form_kobo_id' => $respons['data']['uid']]);
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
