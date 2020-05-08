<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalysisPom extends Model
{

    public $table = "analysis_pom";


    public function sample ()
    {
        return $this->belongsTo(Sample::class);
    }

    public function getResultAttribute ()
    {
        return $this->percent_pom;
    }
}
