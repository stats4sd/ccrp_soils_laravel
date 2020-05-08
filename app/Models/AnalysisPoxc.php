<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalysisPoxc extends Model
{

    public $table = "analysis_poxc";

    public function sample ()
    {
        return $this->belongsTo(Sample::class);
    }

    public function getResultAttribute ()
    {
        return $this->poxc_soil;
    }

    public function getAverageArrayAttribute ()
    {
        $all = AnalysisPoxc::all();

        return [
            'min' => $all->min('poxc_soil'),
            'max' => $all->max('poxc_soil'),
            'mean' => $all->avg('poxc_soil'),
        ];
    }
}
