<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function login(Request $request)
    {
        if(!auth()->check())
            return response()->json(
                        [ "auth" => false]
                    );
        else
            return response()->json(
                    [ "auth" => true]
                );

    }

    public function checkAdmin()
    {
        $current_user = Auth::user();
        //dd($current_user->admin);
        if($current_user->admin)
            return response()->json(
                        [ "admin" => true]
                    );
        else
            return response()->json(
                    [ "adminn" => false]
                );

    }
}
