<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreateProjectController extends Controller
{
     function index()
    {
    	$users = DB::table('users')->get();
    	return view('create_project', ['users' => $users]);
    }

    function upload(Request $request)
    {
    	$this->validate($request, [
    		'select_file' => 'required|image|mimes:jpeg,png,jpg,gif'
    	]);
    	$image = $request->file('select_file');
    	$new_name = rand() . '.' . $image->getClientOriginalExtension();
    	$image->move(public_path("images"), $new_name);
    	return Back()->with('success', 'Image Uploaded Successfully')->with('path', $new_name);
    }	
}
