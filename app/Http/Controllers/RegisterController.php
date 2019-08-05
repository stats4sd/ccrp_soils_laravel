<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use App\Models\ProjectMember;
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
        $this->checkInvite($user->email, $user->id);
    	
    	auth()->login($user);
    	
    	return redirect()->to('en/home');
    }

    public function checkInvite($email, $user_id)
    {
        $invite = Invite::where('email', $email)->first();
        $projects_members = null;
        if($invite!=null)
        {
            $projects_members = new ProjectMember();
            $projects_members->project_id = $invite->project_id;
            $projects_members->inviter_id = $invite->inviter_id;
            $projects_members->user_id = $user_id;
            $projects_members->key_confirm = $invite->key_confirm;
            $projects_members->is_confirmed = $invite->is_confirmed;
            $projects_members->save();
            $invite->delete();

        }
   
        return $projects_members;
    }


}
