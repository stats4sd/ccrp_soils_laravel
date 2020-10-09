<?php

namespace App\Http\Controllers;

use App;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\ProjectXlsform;
use App\Jobs\Projects\ArchiveKoboForm;
use App\Jobs\Projects\GetDataFromKobo;
use App\Jobs\Projects\DeployFormToKobo;
use App\Jobs\Projects\DeploymentSuccessMessage;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ProjectXlsformController extends Controller
{
    public function index(Project $project)
    {
        return $project->project_xlsforms->toJson();
    }


    public function deployToKobo(ProjectXlsform $project_xlsform)
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

    public function download(ProjectXlsform $project_xlsform)
    {
        $scriptPath = base_path('/scripts/download_samples_from_project_submissions_csv.py');
        $base_path = base_path();
        $project_xlsform_id = $project_xlsform->id;
        $title = str_replace("-", "", $project_xlsform->title);
        $file_name = str_replace(" ", "_", $title . ".csv");

        $process = new Process(["pipenv", "run", "python3", $scriptPath, $base_path, $file_name, $project_xlsform_id]);

        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        } else {
            $process->getOutput();
        }

        $path_download =  Storage::url('/merged_sample/' . $file_name);
        return response()->json(['path' => $path_download]);
    }
}
