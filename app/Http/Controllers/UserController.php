<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public function index ()
    {
        $this->authorize('viewAny', User::class);

        return view('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $validatedData = $request->validate(
            [
                'name' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
                'kobo_id' => ['nullable', 'string', 'max:255'],
                'avatar' => ['nullable', 'image'],
            ],
        );

        $user->update($validatedData);

        return redirect()->route('users.show', [$user]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();

        return redirect()->route('users.index');
    }

    /**
     * Returns the show route for the logged-in user
     * @return \Illuminate\Http\Response
     */
    public function account ()
    {
        $user = auth()->user();

        return view('users.show', compact('user'));
    }


    /**
     * Show the Edit password form
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function editPassword (User $user)
    {
        return view('users.edit-password', compact('user'));
    }

    /**
     * Update user password, including existing password validation
     * @param  Request $request Request from the change password form
     * @param  User    $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $request->validate([
            'current_password' => ['required', new MatchOldPassword ],
            'new_password' => ['required'],
            'confirm_password' => ['same:new_password'],
        ]);


       $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('users.show', [$user]);

    }




}
