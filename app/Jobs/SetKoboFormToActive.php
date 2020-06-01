<?php

namespace App\Jobs;

use App\Models\Xlsform;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SetKoboFormToActive implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $form;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Xlsform $form)
    {
        //
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
        if($this->form->version_id) {

            $response = Http::withBasicAuth(config('services.kobo.username'), config('services.kobo.password'))
                ->withHeaders(['Accept' => 'application/json'])
                ->patch(config('services.kobo.endpoint') . '/api/v2/assets/' . $this->form->kobo_id . '/deployment/', [
                    'active' => true,
                    'version_id' => $this->form->version_id,
                ])
                ->throw()
                ->json();
        }

        // Deployment doesn't exist for this form, so POST;
        else {

            $response = Http::withBasicAuth(config('services.kobo.username'),config('services.kobo.password'))
            ->withHeaders(['Accept' => 'application/json'])
            ->post(config('services.kobo.endpoint_v2').'assets/'.$this->form->kobo_id.'/deployment/', [
                'active' => true,
            ])
            ->throw()
            ->json();
        }

        $this->form->update([
            'kobo_version_id' => $response['version_id'],
        ]);


    }

}
