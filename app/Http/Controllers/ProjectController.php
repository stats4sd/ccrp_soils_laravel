<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
	public function index()
    {
    	$users = DB::table('users')->get();
    	return view('project_management', ['users' => $users]);
    }

    

}
