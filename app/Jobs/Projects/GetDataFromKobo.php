<?php

namespace App\Jobs\Projects;

use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Models\ProjectXlsform;
use App\Models\ProjectSubmission;
use Illuminate\Support\Facades\Http;
use App\Events\GetDataFromKoboFailed;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\KoboGetDataReturnedSuccess;
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
                ProjectSubmission::create([
                    'id' => $newSubmission['_id'],
                    'uuid' => $newSubmission['_uuid'],
                    'project_xlsform_id' => $this->form->id,
                    'content' => json_encode($newSubmission),
                    'submitted_at' => $newSubmission['_submission_time'],
                ]);
            }
        }

        event(new KoboGetDataReturnedSuccess(
            $this->user,
            $this->form
        ));

    }
}
