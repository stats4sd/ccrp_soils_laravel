<?php

namespace App\Http\Livewire;

use App\Models\Project;
use App\Models\Xlsform;
use Livewire\Component;
use App\Jobs\TestNotificationSystem;

class FormsTable extends Component
{
    public $project;
    public $forms;
    public $showNotify;

    protected function getListeners()
    {
        $userId = auth()->user()->id;

        return [
            "echo-private:App.User.{$userId},NewProjectFormDeployedToKobo" => 'notifyNewDeployment'];

    }

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->showNotify = false;
    }

    public function deployForm ($form_id)
    {

        // $form = $this->project->xls_forms->find($form_id);

        $this->project->xls_forms()
        ->updateExistingPivot($form_id, [
            'processing' => true
        ]);

        //dispatch deployment job
        //CreateNewKoboForm::dispatch($form, )

        //reply to user

        //TestNotificationSystem::dispatch($form, auth()->user());
    }

    public function notifyNewDeployment ()
    {
        $this->showNotify = true;
    }



    public function render()
    {
        return view('livewire.forms-table');
    }
}
