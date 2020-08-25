<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AnalysisPoxc
 *
 * @property int $id
 * @property string|null $analysis_date
 * @property string $sample_id
 * @property float|null $weight_soil
 * @property float|null $color
 * @property float|null $color100
 * @property float|null $conc_digest
 * @property string|null $cloudy
 * @property float|null $colorimeter
 * @property float|null $raw_conc
 * @property float|null $poxc_sample
 * @property float|null $poxc_soil
 * @property int $correct_moisture
 * @property float|null $moisture
 * @property float|null $poxc_soil_corrected
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $average_array
 * @property-read mixed $result
 * @property-read \App\Models\Sample $sample
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPoxc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPoxc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPoxc query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPoxc whereAnalysisDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPoxc whereCloudy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPoxc whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPoxc whereColor100($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPoxc whereColorimeter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPoxc whereConcDigest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPoxc whereCorrectMoisture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPoxc whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPoxc whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPoxc whereMoisture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPoxc wherePoxcSample($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPoxc wherePoxcSoil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPoxc wherePoxcSoilCorrected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPoxc whereRawConc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPoxc whereSampleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPoxc whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPoxc whereWeightSoil($value)
 * @mixin \Eloquent
 * @property int $project_submission_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPoxc whereProjectSubmissionId($value)
 */
class AnalysisPoxc extends Model
{

    public $table = "analysis_poxc";
    protected $guarded = [];

    public function sample ()
    {
        return $this->belongsTo(Sample::class);
    }

    public function project_submission ()
    {
        return $this->belongsTo(ProjectSubmission::class);
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
