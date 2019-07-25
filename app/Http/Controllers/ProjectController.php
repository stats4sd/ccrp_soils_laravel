<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
	public function index()
    {
    	$users = DB::table('users')->get();
    	$projects =	$this->timeString();;
    	$admins = DB::table('users')->get();
    	$xls_forms = DB::table('xls_forms')->get();
    	$this->timeString();
    	
    	
    	return view('projects', compact('users', 'projects', 'admins','xls_forms'));
    }

    public function timeString()
    {
    	$projects = DB::table('projects')->get();
    	foreach ($projects as $project) {

    		$project->created_at= Carbon::createFromTimeStamp(strtotime($project->created_at))->diffForHumans();
    	}
    	//dd($projects);
    	return $projects;
    	
    }
    

}
