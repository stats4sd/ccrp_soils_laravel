<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalysisPh extends Model
{

    public $table = "analysis_ph";

    public function sample ()
    {
        return $this->belongsTo(Sample::class);
    }

    public function getResultAttribute ()
    {
        return $this->reading_ph;
    }
}
