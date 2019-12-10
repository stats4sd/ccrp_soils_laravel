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
    /**
     * shows the projects in 'All Projects' page that are not deleted and not hidden status.
     * @return [Collection] [projects]
     */
	public function index()
    {
    	$projects = DB::table('projects')->where('deleted_at', null)->whereIn('status', ['Private', 'Public'])->get();
    	return view('projects', compact('projects'));
    }

    
    /**
     * 
     * @param  [type]  $locale  [description]
     * @param  Project $project [description]
     * @return [type]           [description]
     */
    public function show($locale, Project $project)
    {
        $users = DB::table('users')->get();
        $is_member = $this->privacy($project);
        $auth = $project->users->filter(function($value){
            return $value->pivot->is_admin==1;
        });
        $is_admin =$auth->pluck('id')->contains(Auth::id());
        $invitations = $this->invitations($project, $is_admin, $is_member);
            
        return view('project_account', compact('users', 'project', 'is_admin', 'is_member', 'invitations'));    
    } 

    public function privacy($project)
    {
        //checks the status of the project and return who can see the details of the project
        if($project->status == "Public")
        {
            $user = Auth::id();
            return $user;

        }else if($project->status == "Private")
        {
            $is_member = $project->users->contains(Auth::id());
            return $is_member;
        }
    }

    public function invitations($project, $is_admin, $is_member)
    {
        if($project->group_invitations == 'group_admins')
        {
            return $is_admin;
        }elseif($project->group_invitations == 'all_members'){
            return $is_member;
        }
    }



  
    

}
