<?php

namespace App\Http\Controllers;

use App\Http\Controllers\createProjectMember;
use App\Http\Requests\ProjectRequest;
use App\Mail\InviteMember;
use App\Models\Invite;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\Projectxlsform;
use App\Models\Xlsform;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ProjectController extends Controller
{
    /**
     * shows the projects in 'All Projects' page that are not deleted and not hidden status.
     * @return [Collection] [projects]
     */
	public function index()
    {
    	$projects = Project::whereIn('status', ['Private', 'Public'])->get();
    	return view('projects.index', compact('projects'));
    }


    /**
     *
     * @param  Project $project [description]
     * @return [view]           Project account
     */
    public function show(Project $project, $tab = null)
    {

        $project = $project->load([
            'users' => function($q) {
                $q->orderBy('pivot_admin', 'desc');
            },
            'xls_forms',
            ]
        );

        return view('projects.show', compact('project'));
    }

    public function create ()
    {
        return view('projects.create');
    }

    public function store (ProjectRequest $request)
    {

        $validatedData = $request->validated();

        $validatedData['creator_id'] = auth()->user()->id;
        $validatedData['slug'] = Str::slug($validatedData['name']);

        $project = Project::create($validatedData);

        return redirect()->route('projects.show', [$project]);
    }

    public function update (ProjectRequest $request, Project $project)
    {

        $this->authorize('update', $project);

        $validatedData = $request->validated();

        $project->update(array_filter($validatedData));

        return redirect()->route('projects.show', [$project]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        $project->delete();

        return redirect()->route('projects.index');
    }
}
