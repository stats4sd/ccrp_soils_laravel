<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Projectxlsform;
use App\Models\Xlsform;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
	public function index()
    {
    	$users = DB::table('users')->get();
    	$projects =	$this->timeString();

        $myprojects = Auth::user()->projects;

       
        
    	return view('projects', compact('users', 'projects','myprojects'));
    }

    public function myProjects()
    {
        $my_projects = Auth::user()->projects;
        foreach ($my_projects as $proj) {
            $proj->created_at= Carbon::createFromTimeStamp(strtotime($proj->created_at))->diffForHumans();
        }
        return $my_projects;
    }

    public function timeString()
    {
    	$projects = DB::table('projects')->where('deleted_at', null)->get();
    	foreach ($projects as $project) {
            $project->created_at= Carbon::createFromTimeStamp(strtotime($project->created_at))->diffForHumans();
    	}
    	return $projects;
    	
    }
    

}
