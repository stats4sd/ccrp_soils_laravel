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
    	$projects = DB::table('projects')->where('deleted_at', null)->whereIn('status', ['Private', 'Public'])->get();
        $myprojects = $my_projects = Auth::user()->projects;


    	return view('projects', compact('users', 'projects','myprojects'));
    }

    // public function timeString()
    // {
    // 	$projects = DB::table('projects')->where('deleted_at', null)->whereIn('status', ['Private', 'Public'])->get();
    //     //dd($projects);
        
    //     	foreach ($projects as $project) {
    //             $project->created_at= Carbon::createFromTimeStamp(strtotime($project->created_at))->diffForHumans();
    //     	}

        
    // 	return $projects;
    	
    // }
    

}
