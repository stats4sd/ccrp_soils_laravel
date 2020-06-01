<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Xlsform;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ShareFormWithAdmins implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $form;

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
        $admins = User::where('admin', '=', 1)->get();

        $payload = [];

        $permissions = ['change_asset', 'add_submissions', 'change_submissions', 'validate_submissions'];

        foreach($admins as $admin) {
            foreach($permissions as $permission) {
                $payload[] = [
                    'permission' => config('services.kobo.endpoint_v2').'permissions/'.$permission,
                    'user' => config('services.kobo.endpoint_v2').'users/'.$admin->kobo_id,
                ];
            }
        }

        $response = Http::withBasicAuth(config('services.kobo.username'), config('services.kobo.password'))
        ->withHeaders(['Accept' => 'application/json'])
        ->post(config('services.kobo.endpoint_v2').'assets/'.$this->form->kobo_id.'/perimssion_assignments/bulk/', $payload)
        ->throw()
        ->json();



    }
}
