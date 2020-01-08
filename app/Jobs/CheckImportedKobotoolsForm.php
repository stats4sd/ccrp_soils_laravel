<?php

namespace App\Jobs;

use App\Helpers\KoboHelper;
use App\Models\Xlsform;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckImportedKobotoolsForm implements ShouldQueue
{
    // try this as many times as needed to get a "success" response.
    public $tries = 1;
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

        $res = $client->request('GET', "/imports/$this->uid");

        $response = json_decode($res->getBody());

        if((isset($response->status) && $response->status != "complete") || !isset($response->status)) {
            throw new \Exception ("Importing not yet finished in Kobotools. Retrying...");
        }

        // created is an array (to account for possibilities that a single import created multiple assets);
        // here, we assume that we've just uploaded a single xls form file, so just get the [0]th entry.
        $uid = $response->messages->created[0]->uid;

        $formRes = $client->request('GET', "api/v2/assets/$uid/");

        $formResponse = json_decode($formRes->getBody());

        //update ODK form:
        $this->form->content = json_encode($formResponse->content);

        $this->form->save();

    }
}
