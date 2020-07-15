<?php

namespace App\Jobs\Projects;

use App\Models\User;
use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * This job sends a post request to the permission-assignments/bulk endpoint.
 * It updates the permissions of all project forms so that ALL current members have access, and no-one else.
 * This should be run every time a new member is added to a project, and also when a member is removed from the project, to ensure permissions are up to date.
 */
class ShareFormsWithExistingProjectMembers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $project;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $forms = $this->project->project_xlsforms;
        $users = $this->project->users;

        \Log::info("sharing forms with new Users");

        $permissions = ['change_asset', 'add_submissions', 'change_submissions', 'validate_submissions'];

        foreach($forms as $form) {
            \Log::info("sharing form " . $form->title);

            if($form->is_active && $form->kobo_version_id) {
                $payload = [];

                foreach($users as $user) {
                    if($user->kobo_id) {
                        foreach($permissions as $permission) {

                            $payload[] = [
                                'permission' => config('services.kobo.endpoint_v2') . '/permissions/' . $permission . '/',
                                'user' => config('services.kobo.endpoint_v2') . '/users/' . $user->kobo_id . '/',
                            ];
                        }
                    }
                }

                $response = Http::withBasicAuth(config('services.kobo.username'), config('services.kobo.password'))
                ->withHeaders(['Accept' => 'application/json'])
                ->post(config('services.kobo.endpoint_v2') . '/assets/' . $form->kobo_id . '/permission-assignments/bulk/', $payload)
                ->throw()
                ->json();

                \Log::info("new project member assigned to form");
                \Log::info(json_encode($response));

            }
        }
    }
}
