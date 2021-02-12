<?php

namespace App\Observers;

use App\Http\Controllers\DataMapController;
use App\Models\ProjectSubmission;

class ProjectSubmissionObserver
{
    /**
     * Handle the project submission "created" event.
     *
     * @param  \App\Models\ProjectSubmission  $projectSubmission
     * @return void
     */
    public function updated(ProjectSubmission $projectSubmission)
    {
        // // find out what form it came from
        $form = $projectSubmission->project_xlsform->xlsform;
        $project = $projectSubmission->project;

        // re-process submissions from this form
        DataMapController::updateAllRecords($form, $project);
    }

    public function deleting(ProjectSubmission $projectSubmission)
    {
        $projectSubmission->analysis_p()->delete();
        $projectSubmission->analysis_ph()->delete();
        $projectSubmission->analysis_agg()->delete();
        $projectSubmission->analysis_pom()->delete();
        $projectSubmission->analysis_poxc()->delete();
        $projectSubmission->samples()->delete();
    }


    public function deleted(ProjectSubmission $projectSubmission)
    {
        $form = $projectSubmission->project_xlsform->xlsform;
        $project = $projectSubmission->project;

        DataMapController::updateAllRecords($form, $project);
    }
}
