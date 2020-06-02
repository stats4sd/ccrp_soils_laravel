<?php

namespace App\Jobs\Projects;

use App\Models\User;
use App\Models\Projectxlsform;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use App\Events\KoboUploadReturnedError;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\KoboUploadReturnedSuccess;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CheckKoboUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $form;
    public $importUid;

    public $tries = 50;

    /**
     * Create a new job instance.
     * @param User $user
     * @param Projectxlsform $form
     * @param String $importUid
     * @return void
     */
    public function __construct(User $user, Projectxlsform $form, String $importUid)
    {
        $this->user = $user;
        $this->form = $form;
        $this->importUid = $importUid;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $importCheck = Http::withBasicAuth(
            config('services.kobo.username'),
            config('services.kobo.password')
        )
        ->withHeaders(["Accept" => "application/json"])
        ->get(config('services.kobo.endpoint') . '/imports/' . $this->importUid . '/')
        ->throw()
        ->json();


        \Log::info("importCheck");
        \Log::info($importCheck);

        $importStatus = $importCheck['status'];

        if ($importStatus === "processing") {
            $this->release('5');
        }

        // Failed import still returns 200, so check for import status:
        if ($importStatus === 'error') {
            \Log::error("Kobo Upload Error: Type = " . $importCheck['messages']['error_type']);
            \Log::error("Error Message = " . $importCheck['messages']['error']);

            event(new KoboUploadReturnedError(
                $this->user,
                $this->form,
                $importCheck['messages']['error_type'],
                $importCheck['messages']['error']
            ));

            // Throw exception to prevent other jobs in chain running.
            throw new \Exception('Error: ' . $importCheck['messages']['error']);
        }

        if($importStatus == "complete") {
            event(new KoboUploadReturnedSuccess(
                $this->user,
                $this->form
            ));

            // run other actions on Kobo that required a succesfully imported form:
            SetKoboFormToActive::withChain([
                new ShareFormWithAdmins($this->form),
                new DeploymentSuccessMessage($this->user, $this->form),
            ])->dispatch($this->user, $this->form);
        }

    }
}
