<?php

namespace App\Jobs;

use App\Helpers\KoboHelper;
use App\Models\Xlsform;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateKobotoolsFormName implements ShouldQueue
{
    private $form;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        $client = KoboHelper::getClient();

    $res = $client->request('PATCH', "api/v2/assets/" . $this->form->kobo_id . "/", [
            'form_params' => [
                'name' => $this->form->name,
            ],
        ]);

    }
}

