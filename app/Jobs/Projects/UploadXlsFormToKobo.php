<?php

namespace App\Jobs\Projects;

use App\Models\User;
use App\Models\Projectxlsform;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use App\Events\KoboUploadReturnedError;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UploadXlsFormToKobo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $form;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Projectxlsform $form)
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

        $response = Http::withBasicAuth(config('services.kobo.username'), config('services.kobo.password'))
            ->withHeaders(["Accept" => "application/json"])
            ->attach(
                'file',
                Storage::get($this->form->xlsform->xlsfile),
                Str::slug($this->form->xlsform->title)
            )
            ->post(config('services.kobo.endpoint').'/imports/', [
                'destination' => config('services.kobo.endpoint_v2').'/assets/'.$this->form->kobo_id.'/',
                'assetUid' => $this->form->kobo_id,
                'name' => $this->form->xlsform->title,
            ])
            ->throw()
            ->json();

        \Log::info("importing");
        \Log::info($response);

        $importUid = $response['uid'];

        CheckKoboUpload::dispatch($this->user, $this->form, $importUid);


    }


}
