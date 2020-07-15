<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ShareTestFormWithUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $username;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(String $username)
    {
        //
        $this->username = $username;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $testForm = config('services.kobo.test_form');
        $endPoint = config('services.kobo.endpoint_v2');

        $payload = [
            'permission' => $endPoint.'/permissions/add_submissions/',
            'user' => $endPoint.'/users/'.$this->username.'/',
        ];

        $response = Http::withBasicAuth(config('services.kobo.username'), config('services.kobo.password'))
        ->withHeaders(['Accept' => 'application/json'])
        ->post($endPoint.'/assets/'.$testForm.'/permission-assignments/', $payload)
        ->json();



    }
}
