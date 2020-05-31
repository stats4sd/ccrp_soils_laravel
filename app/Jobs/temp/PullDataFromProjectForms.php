<?php

namespace App\Jobs;

use App\Models\Projectxlsform;
use App\Models\Submission;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PullDataFromProjectForms implements ShouldQueue
{
    private $project;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($project)
    {
        //
        $this->project = $project;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // get all forms with KoboIds

        $forms = $this->project->xls_forms;

        $client = new Client();

        $id = config('services.kobo.id');
        $password = config('services.kobo.password');
         $get = [
            'auth' => [$id, $password],
            'headers' => [
                'Accept' => 'application/json'
            ]
        ];

        $forms->each(function($form) use ($client, $get) {
            Log::info("form with ID - " . $form->id . " has kobo_id = " . $form->pivot->form_kobo_id_string);


        // For now, just pull all submissions.
        // Later, when we get to optimising, we should figure out how to not pull ALL submissions every time. Instead, we should:
        // 1. Compare submissions->count() with form->deployment__submission_count.
        // 2. If the same, we know we have all submissions up to today, so we can mark 'latest submission'.
        // 3. Then, in future, we only get submissions starting from that date.

            try {
                $res = $client->request('GET', 'https://kf.kobotoolbox.org/assets/'.$form->pivot->form_kobo_id_string.'/submissions', $get);

                $response = [
                    'status' => $res->getStatusCode(),
                ];

                Log::info('this pivot id = ' . $form->pivot);

                $response['body'] = json_decode($res->getBody(true));

                $count = count($response['body']);

                Log::info('number of responses gained sfrom form with id ' . $form->pivot->form_kobo_id . ' = ' . $count);


                foreach($response['body'] as $entry) {

                    $submission = Submission::firstOrNew(['uuid' => $entry->_uuid]);
                    $submission->uuid = $entry->_uuid;
                    $submission->content = json_encode($entry);
                    $submission->project_id = $form->pivot->project_id;
                    $submission->xlsform_id = $form->id;
                    $submission->save();
                }

            }
            catch(\Exception $e) {
                //log error to debugging log
                Log::error($e->getMessage());
            }

        });




    }
}
