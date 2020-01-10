<?php

namespace App\Jobs;

use App\Helpers\KoboHelper;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ShareKobotoolsForm implements ShouldQueue
{
    private $uid;
    private $users;
    public $tries = 1;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($uid, $users)
    {
        $this->uid = $uid;
        $this->users = $users;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $client = KoboHelper::getClient();

        foreach($this->users as $user) {


            try {

                if($user->kobo_id != null) {

                    $postView = [
                        'json' => [
                            'content_object' => "https://kf.kobotoolbox.org/assets/$this->uid/",
                            'permission' => 'add_submissions',
                            'user' => "https://kf.kobotoolbox.org/users/$user->kobo_id/",
                        ],
                    ];

                    $postAdd = [
                        'json' => [
                            'content_object' => "https://kf.kobotoolbox.org/assets/$this->uid/",
                            'permission' => 'view_submissions',
                            'user' => "https://kf.kobotoolbox.org/users/$user->kobo_id/",
                        ],
                    ];

                    $resView = $client->request('POST', 'permissions/', $postView);
                    $resAdd = $client->request('POST', 'permissions/', $postAdd);

                    $bodyView = json_decode($resView->getBody());
                    $bodyAdd = json_decode($resAdd->getBody());

                }
            }

            catch (\ClientException $e) {
                Log::emergency("Out of cheese error");
                Log::info("Error message: " . $e->getResponse()->getBody(true));
            }

            catch(\RequestException $e) {
                dd($e);
            }
        }
    }
}
