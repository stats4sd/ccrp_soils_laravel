<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProjectMemberController extends Controller
{
    public function create (Project $project)
    {
        $users = User::whereDoesntHave('projects', function (Builder $query) use ($project) {
            $query->where('projects.id', '<>', $project->id);
        })->get();

        return view('project_members.create', compact('project', $users));
    }

}
