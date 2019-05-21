<?php

namespace App\Http\Controllers;

use App\Models\Xlsform;
use Illuminate\Http\Request;

class DownloadsController extends Controller
{
    public function index()
    {
    	$xlsform = Xlsform::all();
    	return view('downloads', compact('xlsform', $xlsform));
    }
}
