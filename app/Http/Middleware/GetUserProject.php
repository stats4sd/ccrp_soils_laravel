<?php

namespace App\Http\Middleware;

use App\Models\Project;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class GetUserProject
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->check()){

            $projects = Auth::user()->projects;

             View::share('array_projects', $projects);
        }
        return $next($request);
    }

}
