<?php

namespace App\Models;

use App\Observers\ProjectObserver;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AnalysisAgg
 *
 * @property-read \App\Models\Sample $sample
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisAgg newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisAgg newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisAgg query()
 * @mixin \Eloquent
 */
class AnalysisAgg extends Model
{
    protected $guarded = [];
    protected $table = "analysis_agg";

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }

    public function project_submission ()
    {
        return $this->belongsTo(ProjectSubmission::class);
    }

}
