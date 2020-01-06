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
    public function index()
    {
    	$users = DB::table('users')->get();
    	return view('create_project', ['users' => $users]);
    }

    
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


    public function upload(Request $request)
    {
        $allowed_image_extension = array("png","jpg","jpeg",'webp');
        $image = $request->file('select_file');

        if(empty($image)){
            return response()->json(
                ["type" => "empty", "message" => "Choose image file to upload."]
            );
        } else if (!empty($image)) {
            $file_extension = strtolower($image->getClientOriginalExtension());
            if(! in_array($file_extension, $allowed_image_extension)){
                return response()->json(
                    [ "type" => "error", "message" => "Upload invalid images. Only PNG, JPEG, JPG and WEBP are allowed."]
                );
            } else {
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path("images"), $new_name);
                return response()->json(
                    ["type" => "success", "message" => "Image uploaded successfully.", "image_path" => 'images/'.$new_name]
                );
            }
        }
    }

    public function store (Request $request)
    {
        $user = Auth::user();
        $creator_id = $user->id;

        $project = new Project();

        $project->name = $request->name;
        $project->creator_id = $creator_id;
        $project->slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($request->name)));
        $project->description = $request->description;
        $project->status = $request->status;
        $project->image = substr($request['image'], strrpos($request['image'], '/' )-7);
        $project->group_invitations = $request->group_invitations;
        $project->save();

        $project_id = $project->id;
        $this->syncProjectXlsForm($project_id);
    
        $this->creatorProject($creator_id, $project_id); 
    
        return response()->json(["type"=>"stored successfully", "project_id"=>$project_id]);
    }

    public function creatorProject($creator_id, $id)
    {
        $key = str_random(32);
        $projects_members = new ProjectMember();
        $projects_members->project_id = $id;
        $projects_members->inviter_id = Auth::user()->id;
        $projects_members->user_id = $creator_id;
        $projects_members->key_confirm = $key;
        $projects_members->is_admin = 1;
        $projects_members->is_confirmed = 1;
        $projects_members->save();
   
        return $projects_members;
        
    }

    public function syncProjectXlsForm($id) 
    {

        $project = Project::find($id);
        $sync=$project->xls_forms()->sync(Xlsform::all()->pluck('id')->toArray());
        return true;

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
        
        
        return redirect(app()->getLocale()."\projects/".$project->slug);
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
