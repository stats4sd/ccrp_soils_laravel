<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function create()
    {
    	return view('register');
    } 

    public function validator(Request $request)
    {
    	$request->validate( 
    	 [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'required_with:password_confirm','same:password_confirm'],
            'username' => ['required','max:225'],
            'password_confirm' => ['required', 'string', 'min:8']
        ]);

        return redirect()->to('en/register');
    }

    public function store(Request $request) 
    {    	
    	$this->validator($request);

    	$user = User::create([
    		'name' => $request['name'],
    		'username' => $request['username'],
    		'email' => $request['email'],
    		'password' => bcrypt($request['password']),
			'remember_token' => $request['_token'], 
			'privacy' => $request['privacy']
    	]);
    	
    	auth()->login($user);
    	
    	return redirect()->to('en/home');
    }


}
