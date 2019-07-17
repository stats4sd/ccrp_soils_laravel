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
    	$projects = DB::table('projects')->get();
    	$admins = DB::table('users')->get();
    	$xls_forms = DB::table('xls_forms')->get();
    	return view('project_management', compact('users', 'projects', 'admins','xls_forms'));
    }

    

}
