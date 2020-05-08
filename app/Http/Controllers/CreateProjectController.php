<?php

namespace App\Http\Controllers;

use App\Mail\InviteMember;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\Projectxlsform;
use App\Models\Xlsform;
use App\Models\Invite;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class CreateProjectController extends Controller
{



    public function validateValue(Request $request)
    {
        $group_name = $_POST['name'];
        $group_description = $_POST['description'];
        if($group_name==null && $group_description==null){
            return response()->json(["type"=>"error", "message" => "<b>Group Name</b> and <b>Group Description</b> are required"]);
        } else if ($group_name==null) {
            return response()->json(["type"=>"error", "message" => "<b>Group Name</b> is required"]);

        } else if ($group_description==null) {
            return response()->json(["type"=>"error", "message" => "<b>Group Description</b> is required"]);

        } else{
            return response()->json(["type" => "success"]);
        }

    }


    public function sendEmail (Request $request)
    {
        $user = Auth::user();
        $creator_name = $user->name;
        $project = Project::find($request->project_id);

        if(!empty($request->name_selected))
        {
            foreach ($request->name_selected as $user_id)
            {
                $user_invited = User::find(($user_id));
                $key = str_random(32);
                $this->createProjectMember($user_id, $request->project_id, $key);

                $data = [ "creator_name"=> $creator_name,
                    "email"=>$user_invited->email, "project_id"=>$project->id, "name_project"=>$project->name, "user_id"=>$user_id, 'url'=>url("en/projects/".$project->slug),
                    "key_confirmed" =>$key
                ];

                Mail::to($user_invited->email)->send(new InviteMember($data));
            }
        }
        if(!empty($request->email_inserted))
        {
            $email_multiple = explode(",", $request->email_inserted);

            foreach($email_multiple as $email)
            {
                $key = str_random(32);
                $this->createInvite($project->creator_id,  $email, $project->id, $key);
                $data = [ "creator_name"=> $creator_name,
                    "email"=>$email, "name_project"=>$project->name, "project_id"=>$project->id, "user_id"=>0, 'url'=>url("en/projects/".$project->slug),
                    "key_confirmed" =>$key
                ];

                Mail::to($email)->send(new InviteMember($data));

            }
        }


        return redirect(app()->getLocale()."/projects/".$project->slug);
    }

    public function createProjectMember($user_id, $id, $key)
    {
        $projects_members = new ProjectMember();
        $projects_members->project_id = $id;
        $projects_members->inviter_id = Auth::user()->id;
        $projects_members->user_id = $user_id;
        $projects_members->key_confirm = $key;
        $projects_members->save();

        return $projects_members;
    }

    public function createInvite($inviter_id, $email, $project_id, $key)
    {
        $invite = new Invite();
        $invite->inviter_id = $inviter_id;
        $invite->email = $email;
        $invite->project_id = $project_id;
        $invite->key_confirm = $key;
        $invite->save();
        return $invite;
    }

}
