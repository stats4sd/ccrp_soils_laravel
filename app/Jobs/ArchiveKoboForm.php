<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Xlsform;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Events\KoboArchiveRequestReturnedError;
use App\Events\KoboArchiveRequestReturnedSuccess;

class ArchiveKoboForm implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;

    public $form;

    /**
     * Create a new job instance.
     * @param User $user,
     * @param Xlsform $form
     * @return void
     */
    public function __construct(User $user, Xlsform $form)
    {
        //
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
        $response = Http::withBasicAuth(config('services.kobo.username'), config('services.kobo.password'))
        ->withHeaders(['Accept' => 'application/json'])
        ->patch(config('services.kobo.endpoint_v2').'/assets/'.$this->form->kobo_id.'/deployment/', [
            'active' => false,
        ]);

        if ($response->failed()) {
            event(new KoboArchiveRequestReturnedError($this->user, $this->form, 'Archive Error', $response['detail']));
            throw new \Exception('Error: ' . $response['detail']);
        }

        $this->form->update([
            'enketo_url' => null,
            'is_active' => false
        ]);

        event(new KoboArchiveRequestReturnedSuccess($this->user, $this->form));

    }
}
