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
class PublishNewFormToKobotools implements ShouldQueue
{
     /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1;
    private $formId;
    private $project;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($project, $formId)
    {
        $this->formId = $formId;
        $this->project = $project;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $form = $this->project->xls_forms->find($this->formId);

        // update form metadata with project info
        $client = KoboHelper::getClient();


        $post = [
            [
                'name' => 'library',
                'contents' => 'false',
            ],
            [
                'name' => 'file',
                'contents' => fopen( public_path("uploads/$form->path_file"), 'r'),
                'filename' => Str::slug($form->form_title),
            ],
        ];

        try {

            $res = $client->request('POST', 'imports/', [
                'multipart' => $post,
            ]);

            $body = json_decode($res->getBody());

            dispatch(new CheckImportedKobotoolsForm($body->uid, $form))
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

