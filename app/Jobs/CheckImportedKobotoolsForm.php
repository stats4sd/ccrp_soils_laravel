<?php

namespace App\Jobs;

use App\Helpers\KoboHelper;
use App\Jobs\DeployKobotoolsForm;
use App\Jobs\PushMediaToKobotoolsForm;
use App\Models\Xlsform;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * To be run after PublishNewFormToKobotools. Checks if the importing is complete on Kobo's servers.
 */
class CheckImportedKobotoolsForm implements ShouldQueue
{
    // try this as many times as needed to get a "success" response.
    public $tries = 0;
    private $uid;
    private $form;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($uid, Xlsform $form)
    {
        //
        $this->uid = $uid;
        $this->form = $form;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = KoboHelper::getClient();

        $res = $client->request('GET', "/imports/$this->uid/");

        $response = json_decode($res->getBody());

        if((isset($response->status) && $response->status != "complete") || !isset($response->status)) {
            throw new \Exception ("Importing not yet finished in Kobotools. Retrying...");
        }

        // created is an array (to account for possibilities that a single import created multiple assets);
        // here, we assume that we've just uploaded a single xls form file, so just get the [0]th entry.
        if(isset($response->messages->created)) {
            $uid = $response->messages->created[0]->uid;
        }
        // When re-deploying, object is called "updated";
        else {
            $uid = $response->messages->updated[0]->uid;
        }

        $formRes = $client->request('GET', "api/v2/assets/$uid/");

        $formResponse = json_decode($formRes->getBody());


        $this->form->content = json_encode($formResponse->content);
        $this->form->kobo_id = $uid;
        $this->form->kobo_import_id = $this->uid;
        $this->form->save();

        //deploy form
        dispatch(new DeployKobotoolsForm($uid));
        dispatch(new PushMediaToKobotoolsForm($this->form));
        dispatch(new UpdateKobotoolsFormName($this->form));


    }

    public function failed ($exception)
    {
        Log::error($excpetion->getMessage());
    }
}
