<?php

namespace App\Http\Controllers;


use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\getMessageBag;

class UserAccountController extends Controller
{
    public function index($en, $username)
    {
    	$user = Auth::user();
    	$projects = Auth::user()->projects;

    	return view('user_account', compact('user', 'projects'));
    }


    public function upload(Request $request, $en, $id)
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
                DB::table('users')->where('id', $id)->update(['avatar' => '/images/'.$new_name]);

                return response()->json(
                    ["type" => "success", "message" => "Image uploaded successfully.", "image_path" => 'images/'.$new_name]
                );
            }
        }
    }

    public function validateDetails(Request $request, $en, $id)
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
        $user = DB::table('users')->where('id', $id)->update(
            [
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'privacy' => $request->privacy,
            ]);
    
        return $user;
    }

    public function changePassword(Request $request, $en, $id)
    {
        $user = User::find($id);


        if (Hash::check($request->password, $user->password) && $request->new_password!=null && $request->new_password!=null){
            if($request->new_password==$request->new_password_confirm){
           $user->fill([
            'password' => Hash::make($request->new_password)
            ])->save();
               dd(Hash::check($request->password, $user->password) && $request->new_password!=null && $request->new_password!=null);
               return Auth::logout();
            }
            return response()->json(['type'=>'error','message'=>"New Password doesn't match with Confirm Password."]);

        } elseif (!Hash::check($request->password, $user->password)) {
            return response()->json(['type'=>'error','message'=>"Password doesn't match our records."]);
        }
        return response()->json(['type'=>'error','message'=>"New password is null"]);
        
           

    }

    public function deleteProfile($en, $id)
    {
        $user = User::find($id);
        $user->projects()->detach();
        $user->delete();
        return response()->json(['type'=>'success','message'=>"Profile Deleted"]);
    }

    public function koboUser(Request $request, $en, $id)
    {
     
        $user = DB::table('users')->where('id', $id)->update(
            [
                'kobo_id' => $request->kobo_id,
            ]);
    
        return response()->json(['type'=>'success','message'=>$request->kobo_id]);;
    }

    
}
