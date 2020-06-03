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
    public function created(ProjectSubmission $projectSubmission)
    {
        // // find out what form it came from
        // $form = $projectSubmission->project_xlsform->xlsform;

        // \Log::info($form);


        // $submissionId = $projectSubmission->id;
        // $data = $projectSubmission->content;
        // $data->project_id = $projectSubmission->project_xlsform->project->id;

        // // Do the funky mapping dance
        // switch ($form->data_map) {
        //     case 'sample':
        //         DataMapController::sample($data, $submissionId);
        //         break;

        //     case 'analysis_p':
        //         DataMapController::analysis_p($data, $submissionId);
        //         break;

        //     case 'analysis_ph':
        //         DataMapController::analysis_ph($data, $submissionId);
        //         break;

        //     case 'analysis_poxc':
        //         DataMapController::analysis_poxc($data, $submissionId);
        //         break;

        //     case 'analysis_pom':
        //         DataMapController::analysis_pom($data, $submissionId);
        //         break;

        //     case 'analysis_agg':
        //         DataMapController::analysis_agg($data, $submissionId);
        //         break;

        //     default:
        //         \Log::warning('No Mapping Found');
        //         break;
        // }

    }
}
