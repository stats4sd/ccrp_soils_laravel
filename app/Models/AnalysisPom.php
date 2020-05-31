<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AnalysisPom
 *
 * @property int $id
 * @property string $sample_id
 * @property float|null $weight_soil
 * @property float|null $diameter_circ_pom
 * @property int|null $weigh_pom_yn
 * @property float|null $weight_cloth
 * @property float|null $weight_pom
 * @property float|null $percent_pom
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $result
 * @property-read \App\Models\Sample $sample
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPom newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPom newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPom query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPom whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPom whereDiameterCircPom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPom whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPom wherePercentPom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPom whereSampleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPom whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPom whereWeighPomYn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPom whereWeightCloth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPom whereWeightPom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPom whereWeightSoil($value)
 * @mixin \Eloquent
 */
class AnalysisPom extends Model
{

    public $table = "analysis_pom";


    public function sample ()
    {
        return $this->belongsTo(Sample::class);
    }

    public function getResultAttribute ()
    {
        return $this->percent_pom;
    }
}