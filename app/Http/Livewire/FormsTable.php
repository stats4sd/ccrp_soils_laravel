<?php

namespace App\Http\Livewire;

use App\Jobs\Projects\DeployFormToKobo;
use App\Models\Project;
use App\Models\Xlsform;
use Livewire\Component;
use App\Jobs\TestNotificationSystem;
use App\Models\ProjectXlsform;

class FormsTable extends Component
{
    public $project;
    public $projectforms;
    public $showNotify;

    protected function getListeners()
    {
        $userId = auth()->user()->id;

        return [
            "echo-private:App.User.{$userId},KoboDeployementReturnedSuccess" => 'koboFormDeployed',
            "echo-private:App.User.{$userId},KoboArchiveRequestReturnedSuccess" => 'koboFormArchived',
        ];

    }

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->projectforms = $project->project_xlsforms;
        $this->showNotify = false;
    }

    public function deployForm ($projectform_id)
    {
        $projectform = ProjectXlsform::find($projectform_id);

        $projectform->update([
            'processing' => true,
        ]);



        //dispatch deployment job
        //DeployFormToKobo::dispatch(auth()->user(), $projectform);

        //reply to user

        //TestNotificationSystem::dispatch($form, auth()->user());
    }

    public function koboFormDeployed ($event)
    {
        ddd($event);
    }



    public function render()
    {
        return view('livewire.forms-table');
    }
}
