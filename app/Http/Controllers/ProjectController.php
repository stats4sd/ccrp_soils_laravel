<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
     public function index()
    {
    	$id =Auth::id();
    	//dd($id);
    	$current_user = get_current_user();
    	//dd($current_user);
    	$groups = DB::select('select * from `groups` where id = ?', [1] );
    	$admins = DB::select('select * from `users` where id = ?', [1] );
    
    	//dd($admins);
    	return view('project_management', compact('groups','admins'));
    }
}
