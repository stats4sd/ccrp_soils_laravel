<?php

namespace App\Http\Controllers;

use App\Mail\InviteMember;
use App\Models\Invite;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\Projectxlsform;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class ProjectAccountController extends Controller
{
    // public function index($locale, $slug)
    // {
    	
    // 	$users = DB::table('users')->get();
    // 	$projects = Project::where('slug','like',$slug)->first();    
    //     $xls_forms = $projects->xls_forms;
    //     $members = $projects->users;
    //     $is_member = $this->privacy($projects, $members);
        
        
    //     $auth = $members->filter(function($value){
    //         return $value->pivot->is_admin==1;
    //     });
    //     $is_admin =$auth->pluck('id')->contains(Auth::id());
    //     $invitations = $this->invitations($projects, $is_admin, $is_member);
            
    // 	return view('project_account', compact('users', 'projects', 'members','xls_forms', 'is_admin', 'is_member', 'invitations'));  	
    // }

    // public function privacy($project, $members)
    // {
    //     if($project->status == "Public")
    //     {
    //         $user = Auth::id();
    //         return $user;

    //     }else if($project->status == "Private")
    //     {
    //         $is_member = $members->contains(Auth::id());
    //         return $is_member;
    //     }
    // }

    // public function invitations($project, $is_admin, $is_member)
    // {
    //     if($project->group_invitations == 'group_admins')
    //     {
    //         return $is_admin;
    //     }elseif($project->group_invitations == 'all_members'){
    //         return $is_member;
    //     }
    // }
    
    // public function uploadImage(Request $request, $en, $id)
    // {
    //     $allowed_image_extension = array("png","jpg","jpeg",'webp');
    //     $image = $request->file('select_file');

    //     if(empty($image)){
    //         return response()->json(
    //             ["type" => "empty", "message" => "Choose image file to upload."]
    //         );
    //     } else if (!empty($image)) {
    //         $file_extension = strtolower($image->getClientOriginalExtension());
    //         if(! in_array($file_extension, $allowed_image_extension)){
    //             return response()->json(
    //                 [ "type" => "error", "message" => "Upload invalid images. Only PNG, JPEG, JPG and WEBP are allowed."]
    //             );
    //         } else {
    //         $new_name = rand() . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path("images"), $new_name);
    //         DB::table('projects')->where('id', $id)->update(['image' => '/images/'.$new_name]);

    //             return response()->json(
    //                 ["type" => "success", "message" => "Image uploaded successfully.", "image_path" => 'images/'.$new_name]
    //             );
    //         }
    //     }
    // }

    // public function validateGroup(Request $request, $en, $id)
    // {

    //     $group_name = $_POST['name'];
    //     $group_description = $_POST['description'];
    //     if($group_name==null && $group_description==null){
    //         return response()->json(["type"=>"error", "message" => "<b>Group Name</b> and <b>Group Description</b> are required"]);
    //     } else if ($group_name==null) {
    //         return response()->json(["type"=>"error", "message" => "<b>Group Name</b> is required"]);

    //     } else if ($group_description==null) {
    //         return response()->json(["type"=>"error", "message" => "<b>Group Description</b> is required"]);

    //     } else{
    //         $this->update($request, $en, $id);
    //         return response()->json(["type"=>"success", "message"=>"Updated group successfully", "project_id"=>$id]);
    //     } 
    // }

    // public function update (Request $request, $en, $id)
    // {
        
    //     $project = DB::table('projects')->where('id', $id)->update(
    //         [
    //             'name' => $request->name,
    //             'description' => $request->description,
    //             'status' => $request->status,
    //             'group_invitations' => $request->group_invitations,
    //         ]);
    
    //     return $project;
    // }

    // public function sendEmail (Request $request, $en, $id)
    // {
    //     $project = Project::find($id);
    //     $creator_id = $project->creator_id;
    //     $creator_name = User::find($creator_id)->name;
    
    //     if(!empty($request->name_selected))
    //     {
    //         foreach ($request->name_selected as $user_id) 
    //         {
    //             $user_invited = User::find(($user_id));
    //             $key = str_random(32);
    //             $this->createProjectMember($user_id, $id, $key); 

    //             $data = [ "creator_name"=> $creator_name, 
    //                 "email"=>$user_invited->email, "project_id"=>$project->id, "name_project"=>$project->name, "user_id"=>$user_id, 'url'=>url("en/projects/".$project->slug),
    //                 "key_confirmed" =>$key
    //             ];
               
    //             Mail::to($user_invited->email)->send(new InviteMember($data));   
                   
    //         }
    //     }
    //     if(!empty($request->email_inserted))
    //     {
    //         $email_multiple = explode(",", $request->email_inserted);


        
    //         foreach($email_multiple as $email)
    //         { 
    //             $user = User::where('email', $email)->get();
    //             $user_first = $user->first();
    //             $is_user = 0;
    //             if(!empty($user_first->id))
    //             {
    //                 $is_user = $user_first->id;
    //             }
    //             $key = str_random(32);
    //             $this->createInvite($creator_id,  $email, $id, $key);
    //             $data = [ "creator_name"=> $creator_name, 
    //                 "email"=>$email, "name_project"=>$project->name, "project_id"=>$project->id, "user_id"=>$is_user, 'url'=>url("en/projects/".$project->slug),
    //                 "key_confirmed" =>$key
    //             ];

    //             Mail::to($email)->send(new InviteMember($data));
             
    //         }  
    //     } 
                
    //     return redirect::back();
    // }

    // public function createProjectMember($user_id, $id, $key)
    // {   
    //     $projects_members = new ProjectMember();
    //     $projects_members->project_id = $id;
    //     $projects_members->inviter_id = Auth::user()->id;
    //     $projects_members->user_id = $user_id;
    //     $projects_members->key_confirm = $key;
    //     $projects_members->save();
   
    //     return $projects_members;
    // }

    // public function createInvite($inviter_id, $email, $project_id, $key)
    // {
    //     $invite = new Invite();
    //     $invite->inviter_id = $inviter_id;
    //     $invite->email = $email;
    //     $invite->project_id = $project_id;
    //     $invite->key_confirm = $key;
    //     $invite->save();
    //     return $invite;
    // }

    // public function changeStatus(Request $request)
    // {
    //     $user_id = $request['userId'];
    //     $project_id = $request['projectId'];
    //     $project_member = ProjectMember::where('user_id', $user_id)->where('project_id', $project_id)->get();
    //     $current_status = $project_member[0]->is_admin;
    //     if($current_status)
    //     {
    //         ProjectMember::where('user_id', $user_id)->where('project_id', $project_id)->update(['is_admin'=>0]);
    //         return response()->json(["type"=>'info', "status"=>"User"]);
    //     } else {
    //         ProjectMember::where('user_id', $user_id)->where('project_id', $project_id)->update(['is_admin'=>1]);
    //         return response()->json(["type"=>'info', "status"=>"Admin"]);

    //     }
    //     return response()->json(["type"=>'info', "message"=>"Status changed"]);
    // }

    // public function deleteMember(Request $request)
    // {
    //     $user_id = $request['userId'];
    //     $project_id = $request['projectId'];
    //     ProjectMember::where('user_id', $user_id)->where('project_id', $project_id)->delete();
    //     $username = User::find($user_id)->username;

    //     return response()->json(["type"=>'success', "message"=>"the user ".$username." is been deleted from the project"]);

    // }
    // // soft delete project
    // public function delete($en, $id)
    // {
    //     $project_id = Project::find($id)->delete();
    //     return response()->json(["type"=>'success', "project_id"=>$project_id->id]);
        
    // }
    // public function deleteForm(Request $request)
    // {
    //     Projectxlsform::where('project_id', $request['projectId'])->where('xlsform_id', $request['formId'])->delete();
    //     return response()->json(["type"=>'success', "project_id"=>$request['projectId']]);
        
    // }

    
}
