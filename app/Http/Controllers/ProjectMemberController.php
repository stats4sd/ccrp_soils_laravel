<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProjectMemberController extends Controller
{
   public function index()
   {
   		$projects = DB::table('projects')->get();
   		$admins = DB::select('select * from users where id = ?', [1]);
   		$xls_forms = DB::select('select * from xls_forms');

    	return view('project_management', compact('projects', 'admins', 'xls_forms'));
    }
}
