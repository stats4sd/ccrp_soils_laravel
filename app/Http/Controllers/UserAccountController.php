<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{
    public function index()
    {
    	$user = Auth::user();
    	return view('user_account', compact('user'));
    }
}
