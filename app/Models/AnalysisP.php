<?php

namespace App\Models;

use App\Models\Sample;
use Illuminate\Database\Eloquent\Model;

class AnalysisP extends Model
{
    public $table = "analysis_p";

    public function sample ()
    {
        return $this->belongsTo(Sample::class);
    }

    public function getResultAttribute ()
    {
        return $this->olsen_p;
    }
}
