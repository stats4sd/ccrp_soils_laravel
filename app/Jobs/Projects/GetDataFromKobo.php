<?php

namespace App\Jobs\Projects;

use App\Models\User;
use App\Models\Sample;
use Illuminate\Bus\Queueable;
use App\Models\ProjectXlsform;
use App\Models\ProjectSubmission;
use Illuminate\Support\Facades\Http;
use App\Events\GetDataFromKoboFailed;
use Illuminate\Queue\SerializesModels;
use App\Events\KoboGetDataReturnedError;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\KoboGetDataReturnedSuccess;
use App\Http\Controllers\DataMapController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GetDataFromKobo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $form;
    public $user;
    public $tries = 50;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, ProjectXlsform $form)
    {
        $this->user = $user;
        $this->form = $form;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Log::info(config('services.kobo.endpoint_v2') . '/assets/' . $this->form->kobo_id . '/data/');


        $response = Http::withBasicAuth(config('services.kobo.username'), config('services.kobo.password'))
        ->withHeaders(['Accept' => 'application/json'])
        ->get(config('services.kobo.endpoint_v2').'/assets/'.$this->form->kobo_id.'/data/');

        \Log::info(json_encode($response->json()));

        if ($response->failed()) {
            if($response->status() === 504) {
                $this->release('5');
            }
            event(new KoboGetDataReturnedError($this->user, $this->form, json_encode($response->json())));
            throw new \Exception('Error: ' . json_encode($response->json()));
        }

        $data = $response['results'];

        //compare
        $submissions = ProjectSubmission::where('project_xlsform_id', '=', $this->form->id)->get();

        foreach($data as $newSubmission) {
            if(!in_array($newSubmission['_id'], $submissions->pluck('id')->toArray())) {
                $projectSubmission = new ProjectSubmission;

                $projectSubmission->id = $newSubmission['_id'];
                $projectSubmission->uuid = $newSubmission['_uuid'];
                $projectSubmission->project_xlsform_id = $this->form->id;
                $projectSubmission->content = json_encode($newSubmission);
                $projectSubmission->submitted_at = $newSubmission['_submission_time'];

                $projectSubmission->save();

                $dataMap = $this->form->xlsform->data_map_id;
                $submissionId = $newSubmission['_id'];
                $projectId = $this->form->project->id;
                $data = $newSubmission;

                // go through submission variables and remove any group names



                // Do the funky mapping dance
                switch ($dataMap) {
                    case 'sample':
                        \Log::info("sample data found");
                        DataMapController::sample($newSubmission, $submissionId, $projectId);

                    break;

                    case 'analysis_p':
                        \Log::info("analysis_p data found");
                        DataMapController::analysis_p($newSubmission, $submissionId);
                        break;

                    case 'analysis_ph':
                        \Log::info("analysis_ph data found");
                        DataMapController::analysis_ph($newSubmission, $submissionId);
                        break;

                    case 'analysis_poxc':
                        \Log::info("analysis_poxc data found");

                        DataMapController::analysis_poxc($newSubmission, $submissionId);
                        break;

                    case 'analysis_pom':
                        \Log::info("analysis_pom data found");

                        DataMapController::analysis_pom($newSubmission, $submissionId);
                        break;

                    case 'analysis_agg':
                        \Log::info("analysis_agg data found");

                        DataMapController::analysis_agg($newSubmission, $submissionId);
                        break;

                    default:
                        \Log::warning('No Mapping Found');
                        break;
                }

            }
        }

        event(new KoboGetDataReturnedSuccess(
            $this->user,
            $this->form
        ));

    }
}
