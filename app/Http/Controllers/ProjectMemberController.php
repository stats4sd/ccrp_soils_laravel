<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\ProjectMemberStoreRequest;
use App\Http\Requests\ProjectMemberUpdateRequest;
use App\Jobs\Projects\ShareFormsWithExistingProjectMembers;
use App\Jobs\Projects\UnshareProjectFormsWithRemovedUser;

class ProjectMemberController extends Controller
{
    /**
     * Direct user to the 'add / invite members' page. Include list of existing users who aren't members to select from.
     *
     * @param Project $project
     * @return void
     */
    public function create (Project $project)
    {
        $users = User::whereDoesntHave('projects', function (Builder $query) use ($project) {
            $query->where('projects.id', '=', $project->id);
        })->get();

        return view('project_members.create', compact('project', 'users'));
    }

    /**
     * Attach users to the project, or send email invites to non-users.
     * New Members are automatically not admins.
     *
     * @param ProjectMemberStoreRequest $request
     * @param Project $project
     * @return void
     */
    public function store (ProjectMemberStoreRequest $request, Project $project)
    {

        $this->authorize('update', $project);

        $data = $request->validated();

        // add existing users to the project
        if(isset($data['users'])) {
            $project->users()->syncWithoutDetaching($data['users']);
            ShareFormsWithExistingProjectMembers::dispatch($project);
        }

        // send invite to non-users
        if(isset($data['emails']) && count(array_filter($data['emails'])) > 0) {
            $project->sendInvites($data['emails']);
        }

        return redirect()->route('projects.show', [$project, 'members']);
    }

    /**
     * Show the project member editing page
     *
     * @param Project $project
     * @param User $user
     * @return void
     */
    public function edit (Project $project, User $user)
    {
        $user = $project->users->find($user->id);

       return view('project_members.edit', compact('project','user'));
    }

    /**
     * Update the access level for existing project member
     *
     * @param ProjectMemberUpdateRequest $request
     * @param Project $project
     * @param User $user
     * @return void
     */
    public function update (ProjectMemberUpdateRequest $request, Project $project, User $user)
    {
        $this->authorize('update', $project);

        $data = $request->validated();

        $project->users()->syncWithoutDetaching([$user->id => ['admin' => $data['admin']]]);

        return redirect()->route('projects.show', [$project, 'members']);
    }

    /**
     * Remove a user from the project.
     *
     * @param Project $project
     * @param User $user
     * @return void
     */
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
            ShareFormsWithExistingProjectMembers::dispatch($project);
            \Alert::add('success', 'User ' . $user->name . ' successfully removed from the project')->flash();
        }

        return redirect()->route('projects.show', [$project, 'members']);
    }




}
