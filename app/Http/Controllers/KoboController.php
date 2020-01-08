<?php

namespace App\Http\Controllers;


use App\Jobs\DeployKobotoolsForm;
use App\Jobs\PublishNewFormToKobotools;
use App\Jobs\PullDataFromProjectForms;
use App\Jobs\ShareFormToKobotools;
use App\Models\Project;
use App\Models\Projectxlsform;
use App\Models\Xlsform;
use GuzzleHttp\Client;
use Illuminate\Foundation\Bus\withChain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KoboController extends Controller
{

    public function publish ($locale, Project $project, $formId)
    {

        // Enter from the project side. Then get the xls_form via relationship (to include pivot)
        dispatch(new PublishNewFormToKobotools($project, $formId));



        // dispatch(new ImportFormToKobotools($formId, $projectId));
        // Projectxlsform::where('project_id', $projectId)->where('xlsform_id', $formId)->update(['deployed'=>1]);
        return   $response = [
                    'status' => 'deployed',
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
