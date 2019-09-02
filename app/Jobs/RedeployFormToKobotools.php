<?php

namespace App\Jobs;

use App\Models\Projectxlsform;
use App\Models\Xlsform;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RedeployFormToKobotools implements ShouldQueue
{

    private $formId;
    private $projectId;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($formId, $projectId)
    {
        $this->formId = $formId;
        $this->projectId = $projectId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $proj_xls = DB::table('project_xlsform')->where('project_id', $this->projectId)->where('xlsform_id', $this->formId)->get();
        $uid = $proj_xls[0]->form_kobo_id_string;
       
        $client = new Client();

        $id = config('services.kobo.id');
        $password = config('services.kobo.password');

        $get = [
                'auth' => [$id, $password],
                'headers' => [
                    'Accept' => 'application/json'
                    ]
                ];
        $resp = $client->request('GET', 'https://kf.kobotoolbox.org/assets/'.$uid.'/', $get);
        $response = json_decode($resp->getBody());
        Xlsform::where('id', $this->formId)->update(['version_id' => $response->version_id]);

        $client_path = new Client();

        $formId = $this->formId;
        $form = Xlsform::find($formId);
        $xlsFile = Storage::disk('uploads')->path($form->path_file);

        $path = [
                    'auth' => [$id, $password],
                    'headers' => [
                        'Accent' => 'application/json'
                    ],

                    'multipart' => [
                        [
                            'name' => 'version_id',
                            'contents' => $response->version_id,
                        ]
                    ]
                ];
    
        $resp_path = $client_path->request('PATCH', 'https://kf.kobotoolbox.org/assets/'.$uid.'/deployment/', $path);
        $response_path = json_decode($resp_path->getBody());
        return $response_path;
    }
}
