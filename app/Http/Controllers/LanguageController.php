<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function changeLanguage (Request $request)
    {

        // Take the route to redirect to, and manually replace the lang inside it.
        //// There's bound to be a better / more elegant way of doing this. But at least this is better than having a seperate method for every language!

        $redirect = $request->redirect;


        $redirect = str_replace(config('app.url').'/', '', $redirect);

        $redirect = explode('/', $redirect);

        array_shift($redirect);

        $redirect = implode('/', $redirect);

        $redirect = $request->lang.'/'.$redirect;


        return redirect($redirect);


    }

}
