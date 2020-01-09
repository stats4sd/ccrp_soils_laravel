<?php

namespace App\Jobs;

use App\Helpers\KoboHelper;
use App\Jobs\CheckImportedKobotoolsForm;
use App\Jobs\DeployKobotoolsForm;
use App\Jobs\RedeployFormToKobotools;
use App\Jobs\ReplaceFormToKobotools;
use App\Jobs\ShareFormToKobotools;
use App\Models\Project;
use App\Models\Projectxlsform;
use App\Models\Xlsform;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Job to push a specific XLS file to Kobotools as a new "Import". For use ONLY with the originals for each Xlsform.
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

        $filePath = $this->form->path_file;

        $post = [
            [
                'name' => 'library',
                'contents' => 'false',
            ],
            [
                'name' => 'file',
                'contents' => fopen( public_path("uploads/$filePath"), 'r'),
                'filename' => Str::slug($this->form->form_title),
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

        catch(\ClientException $e) {
            Log::emergency("Out of cheese error");
            Log::info("Error message: " . $e->getResponse()->getBody(true));
        }

        catch(\RequestException $e) {
            //dd($e);
        }

    }
}
