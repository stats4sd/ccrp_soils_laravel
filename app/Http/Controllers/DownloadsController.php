<?php

namespace App\Http\Controllers;

use App\Models\Xlsform;
use Illuminate\Http\Request;

class DownloadsController extends Controller
{
    public function index()
    {
    	$xlsforms = Xlsform::all();
    	return view('downloads', compact('xlsforms', $xlsforms));
    }
}
