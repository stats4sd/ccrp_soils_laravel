<?php

namespace App\Models\Views;

use App\Models\Sample;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Views\SampleMerged
 *
 * @property int $project_id
 * @property string $sample_id
 * @property string|null $sampling_date
 * @property string|null $username
 * @property string|null $date
 * @property int|null $depth
 * @property string|null $texture
 * @property int|null $at_plot
 * @property string|null $plot_photo
 * @property float|null $longitude
 * @property float|null $latitude
 * @property float|null $altitude
 * @property float|null $accuracy
 * @property string|null $comment
 * @property string|null $farmer_quick
 * @property string|null $community_quick
 * @property int|null $plot_id
 * @property string|null $analysis_p-date
 * @property float|null $analysis_p-weight_soil
 * @property float|null $analysis_p-vol_extract
 * @property float|null $analysis_p-vol_topup
 * @property string|null $analysis_p-cloudy
 * @property float|null $analysis_p-color
 * @property float|null $analysis_p-raw_conc
 * @property float|null $analysis_p-olsen_p
 * @property float|null $analysis_p-blank_water
 * @property int|null $analysis_p-correct_moisture
 * @property float|null $analysis_p-moisture
 * @property float|null $analysis_p-olsen_p_corrected
 * @property string|null $analysis_ph-date
 * @property float|null $analysis_ph-weight_soil
 * @property float|null $analysis_ph-vol_water
 * @property float|null $analysis_ph-reading_ph
 * @property string|null $analysis_ph-stability
 * @property string|null $analysis_poxc-date
 * @property float|null $analysis_poxc-weight_soil
 * @property float|null $analysis_poxc-color
 * @property float|null $analysis_poxc-color100
 * @property float|null $analysis_poxc-conc_digest
 * @property string|null $analysis_poxc-cloudy
 * @property float|null $analysis_poxc-colorimeter
 * @property float|null $analysis_poxc-raw_conc
 * @property float|null $analysis_poxc-poxc_soil
 * @property float|null $analysis_poxc-poxc_sample
 * @property int|null $analysis_poxc-correct_moisture
 * @property float|null $analysis_poxc-moisture
 * @property float|null $analysis_poxc-poxc_soil_corrected
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\Sample|null $sample
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAccuracy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAltitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPBlankWater($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPCloudy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPCorrectMoisture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPMoisture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPOlsenP($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPOlsenPCorrected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPRawConc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPVolExtract($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPVolTopup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPWeightSoil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPhDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPhReadingPh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPhStability($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPhVolWater($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPhWeightSoil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPoxcCloudy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPoxcColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPoxcColor100($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPoxcColorimeter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPoxcConcDigest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPoxcCorrectMoisture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPoxcDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPoxcMoisture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPoxcPoxcSample($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPoxcPoxcSoil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPoxcPoxcSoilCorrected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPoxcRawConc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAnalysisPoxcWeightSoil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereAtPlot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereCommunityQuick($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereFarmerQuick($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged wherePlotId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged wherePlotPhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereSampleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereSamplingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereTexture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Views\SampleMerged whereUsername($value)
 * @mixin \Eloquent
 */
class SampleMerged extends Model
{
    public $table = "samples_merged";

    public function project ()
    {
       return $this->belongsTo(Project::class);
    }

    public function sample ()
    {
       return $this->hasOne(Sample::class);
    }



}
