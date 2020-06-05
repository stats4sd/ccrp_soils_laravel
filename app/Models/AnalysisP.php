<?php

namespace App\Models;

use App\Models\Sample;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AnalysisP
 *
 * @property int $id
 * @property string|null $sample_id
 * @property string|null $analysis_date
 * @property float|null $weight_soil
 * @property float|null $vol_extract
 * @property float|null $vol_topup
 * @property string|null $cloudy
 * @property float|null $color
 * @property float|null $raw_conc
 * @property float|null $olsen_p
 * @property float $blank_water
 * @property int $correct_moisture
 * @property float|null $moisture
 * @property float|null $olsen_p_corrected
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $result
 * @property-read \App\Models\Sample|null $sample
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisP newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisP newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisP query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisP whereAnalysisDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisP whereBlankWater($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisP whereCloudy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisP whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisP whereCorrectMoisture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisP whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisP whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisP whereMoisture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisP whereOlsenP($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisP whereOlsenPCorrected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisP whereRawConc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisP whereSampleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisP whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisP whereVolExtract($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisP whereVolTopup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisP whereWeightSoil($value)
 * @mixin \Eloquent
 * @property int $project_submission_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisP whereProjectSubmissionId($value)
 */
class AnalysisP extends Model
{
    public $table = "analysis_p";
    protected $guarded = [];

    public function sample ()
    {
        return $this->belongsTo(Sample::class);
    }

    public function getResultAttribute ()
    {
        return $this->olsen_p;
    }
}
