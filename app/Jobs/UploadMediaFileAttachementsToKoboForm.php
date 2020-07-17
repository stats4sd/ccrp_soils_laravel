<?php

namespace App\Jobs;

use App\Models\Xlsform;
use Illuminate\Support\Arr;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UploadMediaFileAttachementsToKoboForm implements ShouldQueue
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
        // media upload still works on the OLD Kobo Api, so we need the OLD formid:

        $oldIdResponse = Http::withBasicAuth(config('services.kobo.username'), config('services.kobo.password'))
        ->withHeaders(['Accept' => 'application/json'])
        ->get(config('services.kobo.old_endpoint').'/api/v1/forms?id_string='.$this->form->kobo_id)
        ->throw()
        ->json();

        $koboform = $oldIdResponse[0];


        // delete any existing media from form to make way for fresh upload:
        foreach($koboform['metadata'] as $metadata) {
            if($metadata['data_type'] === "media") {
                Http::withBasicAuth(config('services.kobo.username'),config('services.kobo.password'))
                ->delete(config('services.kobo.old_endpoint').'/api/v1/metadata/'.$metadata->id)
                ->throw();
            }
        }

        foreach($this->form->media as $media) {

            $filename = Arr::last(explode('/',$media));

            $upload = Http::withBasicAuth(config('services.kobo.username'), config('services.kobo.password'))
            ->withHeaders(['Accept' => 'application/json'])
            ->attach(
                'data_file',
                Storage::get($media),
                $filename
            )
            ->post(config('services.kobo.old_endpoint') . '/api/v1/metadata', [
                'xform' => $koboform['formid'],
                'data_type' => 'media',
                'data_value' => $filename,
            ])
            ->throw()
            ->json();

            \Log::info('media file uploaded');
            \Log::info($upload);
        }






    }
}
