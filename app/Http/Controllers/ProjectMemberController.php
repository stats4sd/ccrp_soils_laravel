<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\ProjectMemberStoreRequest;
use App\Http\Requests\ProjectMemberUpdateRequest;


class ProjectMemberController extends Controller
{
    public function create (Project $project)
    {
        $users = User::whereDoesntHave('projects', function (Builder $query) use ($project) {
            $query->where('projects.id', '=', $project->id);
        })->get();

        return view('project_members.create', compact('project', 'users'));
    }

    public function store (ProjectMemberStoreRequest $request, Project $project)
    {

        $this->authorize('update', $project);

        $data = $request->validated();

        if(isset($data['users'])) {
            $project->users()->syncWithoutDetaching($data['users']);
        }

        if(isset($data['emails']) && count(array_filter($data['emails'])) > 0) {
            Log::info('helloooo from the projectmember controller');

            $project->sendInvites($data['emails']);
        }

        return redirect()->route('projects.show', [$project, 'members']);
    }

    public function edit (Project $project, User $user)
    {
        $user = $project->users->find($user->id);

       return view('project_members.edit', compact('project','user'));
    }


    public function update (ProjectMemberUpdateRequest $request, Project $project, User $user)
    {
        $this->authorize('update', $project);

        $data = $request->validated();

        $project->users()->syncWithoutDetaching([$user->id => ['admin' => $data['admin']]]);

        return redirect()->route('projects.show', [$project, 'members']);
    }


    public function destroy (Project $project, User $user)
    {
        $this->authorize('update', $project);

        $admins = $project->admins()->get();
        // if the $user is a $project admin AND is the ONLY project admin... prevent
        if($admins->contains($user) && $admins->count() == 1) {
            \Alert::add('error', 'User not removed - you must keep at least one project admin to manage your project')->flash();
        }
        else {
            $project->users()->detach($user->id);
            \Alert::add('success', 'User ' . $user->name . ' successfully removed from the project')->flash();
        }

        return redirect()->route('projects.show', [$project, 'members']);
    }




}
