<?php

namespace App\Models;

use App\Models\AnalysisP;
use App\Models\AnalysisPh;
use App\Models\AnalysisPom;
use App\Models\AnalysisPoxc;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    public $incrementing = false;


    public function project ()
    {
        return $this->belongsTo(Project::class);
    }

    public function getPoxcResultAttribute ()
    {
        if($this->analysis_poxc) {
            return $this->analysis_poxc->avg('poxc_soil');
        }

        return null;
    }


    public function analysis_p ()
    {
        return $this->hasMany(AnalysisP::class);
    }

    public function analysis_ph ()
    {
        return $this->hasMany(AnalysisPh::class);
    }

    public function analysis_pom ()
    {
        return $this->hasMany(AnalysisPom::class);
    }

    public function analysis_poxc ()
    {
        return $this->hasMany(AnalysisPoxc::class);
    }
}
