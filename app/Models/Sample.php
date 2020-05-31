<?php

namespace App\Models;

use App\Models\AnalysisP;
use App\Models\AnalysisPh;
use App\Models\AnalysisPom;
use App\Models\AnalysisPoxc;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Sample
 *
 * @property string $id
 * @property string|null $username
 * @property int|null $site_id
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
 * @property string|null $community_quick
 * @property int $project_id
 * @property string|null $farmer_quick
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AnalysisP[] $analysis_p
 * @property-read int|null $analysis_p_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AnalysisPh[] $analysis_ph
 * @property-read int|null $analysis_ph_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AnalysisPom[] $analysis_pom
 * @property-read int|null $analysis_pom_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AnalysisPoxc[] $analysis_poxc
 * @property-read int|null $analysis_poxc_count
 * @property-read mixed $poxc_result
 * @property-read \App\Models\Project $project
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sample newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sample newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sample query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sample whereAccuracy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sample whereAltitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sample whereAtPlot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sample whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sample whereCommunityQuick($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sample whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sample whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sample whereDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sample whereFarmerQuick($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sample whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sample whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sample whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sample wherePlotPhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sample whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sample whereSiteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sample whereTexture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sample whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sample whereUsername($value)
 * @mixin \Eloquent
 */
class Sample extends Model
{
    public $incrementing = false;


    public function project ()
    {
        return $this->belongsTo(Project::class);
    }

    public function getPoxcResultAttribute ()
    {
        if($this->analysis_poxc) {
            return $this->analysis_poxc->avg('poxc_soil');
        }

        return null;
    }


    public function analysis_p ()
    {
        return $this->hasMany(AnalysisP::class);
    }

    public function analysis_ph ()
    {
        return $this->hasMany(AnalysisPh::class);
    }

    public function analysis_pom ()
    {
        return $this->hasMany(AnalysisPom::class);
    }

    public function analysis_poxc ()
    {
        return $this->hasMany(AnalysisPoxc::class);
    }
}