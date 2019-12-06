<?php

namespace App\Http\Controllers;

use App\Jobs\ShareFormToKobotools;
use App\Models\Invite;
use App\Models\ProjectMember;
use App\Models\Xlsform;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function index($en, $key = null)
    {
        if($key)
        {
            $email = $this->includeEmail($key);
        }else {
            $email = null;
        }

    	return view('register', compact('email'));
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
			'privacy' => $request['privacy'],
            'kobo_id' => $request['kobo_id']
    	]);
        $this->checkInvite($user->email, $user->id);

    	auth()->login($user);

    	return redirect()->to('en/home');
    }

    public function checkInvite($email, $user_id)
    {
        $invite = Invite::where('email', $email)->first();
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
            return $projects_members;

        }
        
        return $invite;
    }

    public function includeEmail($key)
    {
        $invite = Invite::where('key_confirm', $key)->first();
        return $invite->email;
    }


}
