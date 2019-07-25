<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\ProjectMember;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      
        if(auth()){
        $user_id = Auth::User();
        
        $projects_id = DB::table('projects_members')->select('group_id')->where('user_id', 1)->get();
        $array = array_column($projects_id->all(), 'group_id');
        
        
        $project_prop;
        $array_projects = [];
       
        foreach ($array as $id){
     
            $project_prop['name'] = Project::find($id)->name; 
        
            $project_prop['slug']= Project::find($id)->slug;
       
            $project_prop['image']= Project::find($id)->image;

            $array_projects[]=$project_prop;
            }

        }   
        //dd($array_projects); 
        
        View::share('array_projects', $array_projects);    

        
    }
        
       
   
}
