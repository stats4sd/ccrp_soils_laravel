<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AnalysisPh
 *
 * @property int $id
 * @property string $sample_id
 * @property string|null $analysis_date
 * @property float|null $weight_soil
 * @property float|null $vol_water
 * @property float|null $reading_ph
 * @property string|null $stability
 * @property string|null $start
 * @property string|null $end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $result
 * @property-read \App\Models\Sample $sample
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPh newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPh newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPh query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPh whereAnalysisDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPh whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPh whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPh whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPh whereReadingPh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPh whereSampleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPh whereStability($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPh whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPh whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPh whereVolWater($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPh whereWeightSoil($value)
 * @mixin \Eloquent
 */
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
