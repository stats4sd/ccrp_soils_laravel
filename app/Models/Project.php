<?php

namespace App\Models;

use App\Models\Sample;
use App\Models\Submission;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use CrudTrait;
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $guarded = ['id'];

    protected $casts = [
        'share_data' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS / Getters / Setters
    |--------------------------------------------------------------------------
    */

    public function getAdminsAttribute ()
    {
        return $this->users->where('pivot.admin', true);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setAvatarAttribute($value)
    {
        $disk = "public";
        $destination_path = "projects/avatars";
        $this->uploadFileToDisk($value, "avatar", $disk, $destination_path);
    }


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function xls_forms ()
    {
        return $this->belongsToMany(Xlsform::class)->using(Projectxlsform::class)
        ->withPivot([
            'kobo_id',
            'deployed',
            'records',
        ]);
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'projects_members')->withPivot('admin');
    }

    public function submissions ()
    {
        return $this->hasMany(Submission::class);
    }

    public function samples ()
    {
        return $this->hasMany(Sample::class);
    }


}
