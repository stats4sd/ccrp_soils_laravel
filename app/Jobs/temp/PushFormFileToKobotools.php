<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use App\Models\Project;
use App\Models\Xlsform;
use App\Helpers\KoboHelper;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use App\Models\Projectxlsform;
use App\Jobs\DeployKobotoolsForm;
use App\Jobs\ShareFormToKobotools;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Jobs\ReplaceFormToKobotools;
use App\Jobs\RedeployFormToKobotools;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Jobs\CheckImportedKobotoolsForm;
use Illuminate\Queue\InteractsWithQueue;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Job to push a specific XLS file to Kobotools. Pushes as a 'new' form if Xlsform->kobo_id is null. Otherwise assumes form already exists on Kobotools and sends an update request.
 */
class PushFormFileToKobotools implements ShouldQueue
{
     /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1;
    private $form;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Xlsform $form)
    {
        $this->form = $form;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        // update form metadata with project info
        $client = KoboHelper::getClient();

        $filePath = $this->form->xlsfile;

        $post = [
            [
                'name' => 'library',
                'contents' => 'false',
            ],
            [
                'name' => 'file',
                'contents' => fopen( public_path($filePath), 'r'),
                'filename' => Str::slug($this->form->title),
            ],
        ];

        if($this->form->kobo_id != null) {
            $post[] = [
                'name' => 'assetUid',
                'contents' => $this->form->kobo_id,
            ];
            $post[] = [
                'name' => 'destination',
                'contents' => config('services.kobo.endpoint') . "/api/v2/assets/" . $this->form->kobo_id . "/",
            ];
        }

        try {

            $res = $client->request('POST', "imports/", [
                'multipart' => $post,
            ]);

            $body = json_decode($res->getBody());

            dispatch(new CheckImportedKobotoolsForm($body->uid, $this->form))
            ->delay(now()->addSeconds(2));

        }

        catch(ClientException $e) {
            Log::emergency("Out of cheese error");
            Log::info("Error message: " . $e->getResponse()->getBody(true));
        }

        catch(RequestException $e) {
            //dd($e);
        }

    }
}

