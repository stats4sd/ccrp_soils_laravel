<?php

namespace App\Http\Controllers;


use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    	//dd($request);
    	$this->validate($request, [

    		'group_name' => 'required|max:200',
    		'description' => 'required',
    	]);
    
    	
    	return Redirect::back();
    }

    public function upload(Request $request)
    {
    	$this->validate($request, [
    		'select_file' => 'required|image|mimes:jpeg,png,jpg'
    	]);
    	$image = $request->file('select_file');
    	$new_name = rand() . '.' . $image->getClientOriginalExtension();
    	$image->move(public_path("images"), $new_name);
    	return Back()->with('success', 'Image Uploaded Successfully')->with('path', $new_name);
    }

    public function store (Request $request)
    {
    	//dd($request);
    	$this->upload($request);

    	$name = $_POST['group_name'];
    	$description = $_POST['description'];
    	$status = $_POST['type_group'];
    	//dd($name_group); 
    	$newgGroup = array('name' => $name, 'description' => $description, 'status' =>'public');
    	
    	DB::table('groups')->insert(['name' => $name, 'description' => $description, 'status' =>'public'])->get;
    	dd($request);

    }

}
