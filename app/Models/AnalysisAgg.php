<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalysisAgg extends Model
{
    protected $guarded = [];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }
}
