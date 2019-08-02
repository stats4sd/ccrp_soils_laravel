<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ConfirmProjectController extends Controller
{
    public function index($en, $id)
    {
    	$project = Project::find($id);
    	return view('confirm_project', compact('project'));
    }
}
