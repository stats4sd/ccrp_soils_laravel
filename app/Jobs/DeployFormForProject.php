<?php

namespace App\Jobs;

use App\Helpers\KoboHelper;
use App\Jobs\DeployKobotoolsForm;
use App\Jobs\ShareKobotoolsForm;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeployFormForProject implements ShouldQueue
{
    private $project;
    private $form;
    public $tries = 1;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($project, $form)
    {
        //
        $this->project = $project;
        $this->form = $form;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $form = $this->project->xls_forms->find($this->form->id);
        $name = $this->project->name . " - " . $form->form_title;

        $client = KoboHelper::getClient();

        $post = [
            'json' => [
                'name' => $name,
                'asset_type' => 'survey',
                'content' => $form->content,
            ],
        ];

        $res = $client->request('POST', 'api/v2/assets/', $post);

        $body = json_decode($res->getBody());

        $this->project->xls_forms()->updateExistingPivot(
            $this->form->id,
            [
                'kobo_id' => $body->uid,
                'deployed' => 1,
            ]
        );

        dispatch(new DeployKobotoolsForm($body->uid));
        dispatch(new ShareKobotoolsForm($body->uid, $this->project->users));



    }

    public function failed ($e)
    {
        dd($e->getMessage());
    }
}
