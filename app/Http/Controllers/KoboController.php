<?php

namespace App\Http\Controllers;


use App\Jobs\DeployKobotoolsForm;
use App\Jobs\PublishFormToKobotools;
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

    public function publish (Request $request)
    {
        $project = Project::find($request->projectId);

        // When a model is serialised to be passed to a job, it loses any "pivot" properties. So we send the formId instead of the actual form model:
        dispatch(new PublishFormToKobotools($request->formId, $project));


    }



    public function getProjectData (Request $request)
    {
        $project = Project::find($request->projectId);

        dispatch(new PullDataFromProjectForms($project));

        return $response = [ 'status' => 'testing' ];
    }

    public function share(Request $request)
    {
        //dd($request);
        $formId = $request->formId;
        $projectId = $request->projectId;

        $project = Project::find($projectId);
        $members = $project->users;

        foreach ($members as $member)
        {
            dispatch(new ShareFormToKobotools($formId,  $projectId, $member->kobo_id));
        }

        return $response = ['status' =>'shared'];




    }


}
