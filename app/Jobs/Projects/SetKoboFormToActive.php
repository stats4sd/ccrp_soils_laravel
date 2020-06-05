<?php

namespace App\Jobs\Projects;

use App\Models\User;
use App\Models\ProjectXlsform;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\KoboDeploymentReturnedError;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SetKoboFormToActive implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $form;

    /**
     * Create a new job instance.
     * @param User $user
     * @param ProjectXlsform $form
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

        // Deployement already exists, so PATCH with existing version_id;
        if($this->form->kobo_version_id) {

            $response = Http::withBasicAuth(config('services.kobo.username'), config('services.kobo.password'))
                ->withHeaders(['Accept' => 'application/json'])
                ->patch(config('services.kobo.endpoint') . '/api/v2/assets/' . $this->form->kobo_id . '/deployment/', [
                    'active' => true,
                    'version_id' => $this->form->kobo_version_id,
                ]);
        }

        // Deployment doesn't exist for this form, so POST;
        else {

            $response = Http::withBasicAuth(config('services.kobo.username'),config('services.kobo.password'))
            ->withHeaders(['Accept' => 'application/json'])
            ->post(config('services.kobo.endpoint_v2').'/assets/'.$this->form->kobo_id.'/deployment/', [
                'active' => true,
            ]);
        }

        if($response->failed()) {
            $this->form->update([
                'processing' => 0,
            ]);
            event(new KoboDeploymentReturnedError($this->user, $this->form, 'Deployment Error', json_encode($response->json())));
            throw new \Exception('Error: ' . json_encode($response->json()));
        }

        $response = $response->json();

        $this->form->update([
            'kobo_version_id' => $response['version_id'],
            'enketo_url' => $response['asset']['deployment__links']['url'],
            'is_active' => true,
            'processing' => false,
        ]);


    }
}
