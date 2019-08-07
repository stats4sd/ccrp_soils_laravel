<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserAccountController extends Controller
{
    public function index()
    {
    	$user = Auth::user();
    	$projects = Auth::user()->projects;

    	return view('user_account', compact('user', 'projects'));
    }

    // public function myProjects()
    // {
    //     $my_projects = Auth::user()->projects;
    //     foreach ($my_projects as $proj) {
    //         $proj->created_at= Carbon::createFromTimeStamp(strtotime($proj->created_at))->diffForHumans();
    //     }
    //     return $my_projects;
    // }
}
