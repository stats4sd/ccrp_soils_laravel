<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\ProjectXlsform;
use App\Jobs\Projects\ArchiveKoboForm;
use App\Jobs\Projects\GetDataFromKobo;
use App\Jobs\Projects\DeployFormToKobo;
use App\Jobs\Projects\DeploymentSuccessMessage;

class ProjectXlsformController extends Controller
{

    public function index (Project $project)
    {
        return $project->project_xlsforms->toJson();
    }


    public function deployToKobo (ProjectXlsform $project_xlsform)
    {
        $project_xlsform->update([
            'processing' => true,
        ]);

        DeployFormToKobo::dispatch(auth()->user(), $project_xlsform);

        //DeploymentSuccessMessage::dispatch(auth()->user(), $project_xlsform);
        return response()->json([
            'title' => $project_xlsform->title,
            'user' => auth()->user()->email,
        ]);
    }

    public function syncData(ProjectXlsform $project_xlsform)
    {
        GetDataFromKobo::dispatch(auth()->user(), $project_xlsform);
        return response()->json([
            'title' => $project_xlsform->title,
            'user' => auth()->user()->email,
        ]);
    }

    public function getData(ProjectXlsform $project_xlsform)
    {
        $submissions = $project_xlsform->project_submissions;
        return $submissions->toJson();
    }

    public function archiveOnKobo(ProjectXlsform $project_xlsform)
    {
        ArchiveKoboForm::dispatch(auth()->user(), $project_xlsform);

        return response()->json([
            'title' => $project_xlsform->title,
            'user' => auth()->user()->email,
        ]);
    }

}
