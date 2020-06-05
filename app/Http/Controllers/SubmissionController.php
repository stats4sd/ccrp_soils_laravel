<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Xlsform;
use App\Models\Submission;
use Illuminate\Http\Request;
use App\Exports\SubmissionExport;


class SubmissionController extends Controller
{
    public function download (Xlsform $xlsform)
    {
        $date = Carbon::now()->toDateTimeString();
        return (new SubmissionExport)->forForm($xlsform->id)->download($xlsform->title . '-submission_data-' . $date . ".xlsx");
    }
}
