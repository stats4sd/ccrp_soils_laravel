<?php

namespace App\Models;

use App\Models\ProjectXlsform;
use Illuminate\Database\Eloquent\Model;

class ProjectSubmission extends Model
{
    protected $table = 'project_submissions';
    protected $guarded = [];

    public function project_xlsform ()
    {
       return $this->belongsTo(ProjectXlsform::class, 'project_xlsform_id');
    }


}
