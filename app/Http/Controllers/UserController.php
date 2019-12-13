<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($en, User $user)
    {
        return view('user_account', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, User $user)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function upload(Request $request, $locale, $id)
    {
        $allowed_image_extension = array("png","jpg","jpeg",'webp');
        $image = $request->file('select_file');

        if(empty($image)){
            return response()->json(
                ["type" => "empty", "message" => "Choose image file to upload."]
            );
        } else if (!empty($image)) {
            $file_extension = strtolower($image->getClientOriginalExtension());
            if(! in_array($file_extension, $allowed_image_extension)){
                return response()->json(
                    [ "type" => "error", "message" => "Upload invalid images. Only PNG, JPEG, JPG and WEBP are allowed."]
                );
            } else {
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path("images"), $new_name);
                User::where('id', $id)->update(['avatar' => '/images/'.$new_name]);

                return response()->json(
                    ["type" => "success", "message" => "Image uploaded successfully.", "image_path" => 'images/'.$new_name]
                );
            }
        }
    }

    public function validateDetails(Request $request, $locale, $id)
    {
        $validator = $request->validate( 
        [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'username' => ['required','max:225']
        ]);

        $this->update($request, $id);
        return response()->json(['success' => true, "message"=>$validator]);
    }
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->update(
            [
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'privacy' => $request->privacy,
            ]);
    
        return $user;
    }

    public function changePassword(Request $request, $locale, $id)
    {
    
        $user = User::find($id);
        if (Hash::check($request->password, $user->password) && Hash::check($request->new_password, $request->new_password_confirm)){
            
           $user->fill([
            
            'password' => Hash::make($request->new_password)
            
            ])->save();

            Auth::logout();
            return response()->json(['type'=>'success','message'=>"New password updated"]);   
        }
            
        return response()->json(['type'=>'error','message'=>'Password Invalid']);   

    }

    public function deleteProfile($locale, $id)
    {
        $user = User::find($id);
        $user->projects()->detach();
        $user->delete();
        return response()->json(['type'=>'success','message'=>"Profile Deleted"]);
    }

    public function koboUser(Request $request, $en, $id)
    {
     
        User::where('id', $id)->update(
            [
                'kobo_id' => $request->kobo_id,
            ]);
    
        return response()->json(['type'=>'success','message'=>$request->kobo_id]);;
    }

     public function privacy($username)
    {
        $user = User::where('username', $username)->first();
        if($user->privacy == "Everyone")
        {
            return true;
        }else if($user->privacy =="Only Me")
        {
            return false;
        }else if ($user->privacy == "All Members") 
        {
            $projects = $user->projects;

            foreach ($projects as $proj) {
                $projects = Project::find($proj->id); 
                $members = $projects->users;
                $is_member = $members->contains(Auth::id());
                if($is_member){
                    return true;
                }

            }
        }
            
           
    }

}
