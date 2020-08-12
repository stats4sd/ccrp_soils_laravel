<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Exports\SampleMergedExport;

class SampleMergedController extends Controller
{
    public function download (Project $project)
    {
        $date = Carbon::now()->toDateTimeString();
        return (new SampleMergedExport)->forProject($project->id)->download($project->name.'-all_sample_data-'.$date.".xlsx");
    }

  
}
