<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use App\Models\Project;
use App\Models\ProjectMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ConfirmProjectController extends Controller
{
    public function index($en, $project_id, $user_id, $key)
    {
    	$project = Project::find($project_id);
    	$is_user = $this->confirmProject($project_id, $user_id, $key);
    	return view('confirm_project', compact('project', 'is_user'));
    }

    public function confirmProject($project_id, $user_id, $key)
    {	
    	if($user_id!=0)
    	{
	    	$is_confirmed = ProjectMember::where('key_confirm', $key)->where('user_id', $user_id)->update(['is_confirmed' => 1]); 
	    }else 
	    {
	    	$is_confirmed = Invite::where('key_confirm', $key)->update(['is_confirmed' => 1]);
	    }
    	return $user_id;
    }

}
