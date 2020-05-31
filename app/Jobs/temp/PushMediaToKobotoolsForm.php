<?php

namespace App\Jobs;

use App\Helpers\KoboHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class PushMediaToKobotoolsForm implements ShouldQueue
{
    private $form;
    public $tries = 1;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($form)
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

        $oldClient = KoboHelper::getOldClient();

        //********** TODO: Fix to use api/v2 once Kobotools team have finished writing the media file uploader!

        //get correct form id for OLD API
        $res = $oldClient->request('GET', "api/v1/forms?id_string=" . $this->form->kobo_id);

        $response = json_decode($res->getBody());

        error_log((string) $res->getBody());

        //queries in this format return an array.
        $koboform = $response[0];

        //********** TODO: turn xls_form_media into a seperate table, to track individual files instead of doing this ugly bulk delete / re-upload on every xlsform save...

        //delete existing media on kobo
        $mediafiles = $koboform->metadata;

        try {

            foreach($mediafiles as $file) {
                if($file->data_type == "media") {
                    $deletion = $oldClient->request("DELETE", "api/v1/metadata/$file->id");
                }
            }
        }

        catch (\Exception $e) {
            Log::error("failed to delete old media file from Kobotools: ");
            Log::error($e->getResponse()->getBody(true));
        }

        finally {

            $newMedia = $this->form->media;

            foreach($newMedia as $filePath) {

                $file = Storage::disk('public')->get($filePath);

                $fileName = explode(".", basename($filePath));
                array_pop($fileName);
                $fileNameNoType = implode(".",$fileName);

                $post = [
                    'multipart' => [
                        [
                            'name' => 'xform',
                            'contents' => $koboform->formid,
                        ],
                        [
                            'name' => 'data_type',
                            'contents' => 'media',
                        ],
                        [
                            'name' => 'data_value',
                            'contents' => $fileNameNoType,
                        ],
                        [
                            'name' => 'data_file',
                            'contents' => $file,
                            'filename' => basename($filePath),
                        ],
                    ]
                ];

                $res = $oldClient->request('POST', "api/v1/metadata", $post);

                $response = $res->getStatusCode();

                if($response != 200 && $response != 201) {
                    Log::error("Pushing media file to Kobotools failed with code: $response");
                    Log::error($res->getBody());
                }
            }
        }
    }
}
