<?php

namespace App\Http\Controllers;

use App\Mail\InviteMember;
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
   
        //dd($request);
        $user = Auth::user();
        $creator_id = $user->id;
        $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($request->name)));
        $newProject = $request->all();
        $newProject['creator_id'] = $creator_id;
        $newProject['slug'] = $slug;
        $newProject['image'] = substr($newProject['image'], strrpos($newProject['image'], '/' )-6);
        $newProject['created_at'] = now();
        $newProject['updated_at'] = now();
        unset($newProject['_token']);

        DB::table('projects')->insert($newProject);

        return response()->json(["type"=>"success"]);
    }

    public function sendEmail (Request $request)
    {
        dd($request);
        $data = array(
                'name' => 'lucia',
                'email' => 'email@gmail.com',
                'creator_id' =>'Creator name',
        );

        Mail::to('lucia@stats4sd.org')->send(new InviteMember($data));
        dd($request->input('name_selected'));
         return response()->json(["type"=>"success"]);
    }


}
