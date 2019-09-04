<?php

namespace App\Models;

use App\Models\Project;
use App\Models\Projectxlsform;
use App\Models\Xlsform;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{

    protected $table = 'submissions';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];

    // protected $hidden = [];
    // protected $dates = [];
    //

    public function project ()
    {
        return $this->belongsTo(Project::class);
    }

    public function xls_form ()
    {
        return $this->belongsTo(Xlsform::class);
    }
}
