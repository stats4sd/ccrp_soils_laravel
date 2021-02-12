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

        // re-process submissions from this form
        DataMapController::updateAllRecords($form);

    }
}
