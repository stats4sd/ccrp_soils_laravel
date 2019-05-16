<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

class HomeController extends Controller
{
	function index()
	{
		return view('home');
	}
	function checklogin(Request $request)
	{
		//dd($request);
		$this->validate($request, [
			'name' => 'required',
			'password' => 'required|alphaNum|min:6'
		]);
		$user_data = array(
			'name' => $request->get('name'),
			'password' => $request->get('password')
		);
		//dd(Auth::attempt($user_data));

		if(Auth::attempt($user_data))
		{
			return redirect('home/successlogin');
		}
		else
		{
			return back()->with('error', 'Wrong Login Details');
		}
	}


	function successlogin()
	{
		return view('home');
	}


	function logout()
	{
		Auth::logout();
		return redirect('home');
	}
  
}
