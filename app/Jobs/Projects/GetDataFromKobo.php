<?php

namespace App\Jobs\Projects;

use Throwable;
use App\Models\User;
use App\Models\Sample;
use App\Models\DataMap;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use App\Helpers\GenericHelper;
use App\Models\ProjectXlsform;
use App\Models\ProjectSubmission;
use Illuminate\Support\Facades\Log;
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
    public $tries = 10;

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
            if ($response->status() === 504) {
                $this->release('5');
            }
            event(new KoboGetDataReturnedError($this->user, $this->form, json_encode($response->json())));
            throw new \Exception('Error: ' . json_encode($response->json()));
        }

        $data = $response['results'];

        //compare
        $submissions = ProjectSubmission::withTrashed()->withoutGlobalScope('project')->where('project_id', $this->form->project->id)->where('project_xlsform_id', '=', $this->form->id)->get();

        foreach ($data as $newSubmission) {
            if (!in_array($newSubmission['_id'], $submissions->pluck('id')->toArray())) {

                // include any static extra data variables from the form definition

                if ($this->form->xlsform->extra_data && is_array($this->form->xlsform->extra_data)) {
                    foreach ($this->form->xlsform->extra_data as $field) {
                        $variable = $field['variable'];

                        $newSubmission[$variable] = $field['value'];
                    }
                }

                $projectSubmission = new ProjectSubmission;

                $projectSubmission->id = $newSubmission['_id'];
                $projectSubmission->uuid = $newSubmission['_uuid'];
                $projectSubmission->project_xlsform_id = $this->form->id;
                $projectSubmission->project_id = $this->form->project->id;
                $projectSubmission->content = json_encode($newSubmission);
                $projectSubmission->submitted_at = $newSubmission['_submission_time'];

                $projectSubmission->save();

                $dataMap = DataMap::findorfail($this->form->xlsform->data_map_id);
                $submissionId = $newSubmission['_id'];
                $projectId = $this->form->project->id;
                $data = $newSubmission;

                $newSubmission = GenericHelper::remove_group_names_from_kobo_data($newSubmission);

                \Log::info("Mapping data to correct model / tables...");
                \Log::info($newSubmission);

                DataMapController::newRecord($dataMap, $newSubmission, $projectId);
            }
        }

        event(new KoboGetDataReturnedSuccess(
            $this->user,
            $this->form
        ));
    }

    public function failed(Throwable $exception)
    {
        event(new KoboGetDataReturnedError(
            $this->user,
            $this->form,
            $exception
        ));
    }
}
