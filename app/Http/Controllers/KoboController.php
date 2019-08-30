<?php

namespace App\Http\Controllers;


use App\Jobs\DeployKobotoolsForm;
use App\Jobs\ImportFormToKobotools;
use App\Jobs\PullDataFromProjectForms;
use App\Jobs\ShareFormToKobotools;
use App\Models\Project;
use App\Models\Xlsform;
use GuzzleHttp\Client;
use Illuminate\Foundation\Bus\withChain;
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

        dispatch(new ImportFormToKobotools($formId, $projectId));

        return   $response = [
                    'status' => 'imported',
            ];
    }

    public function getProjectData (Request $request)
    {
        $project = Project::find($request->projectId);

        dispatch(new PullDataFromProjectForms($project));

        return $response = [ 'status' => 'testing' ];
    }

    public function share(Request $request)
    {
        $formId = $request->formId;
        $projectId = $request->projectId;

        dispatch(new ShareFormToKobotools($formId, $projectId));

        return   $response = [
                    'status' => 'shared',
            ];
    }


}
