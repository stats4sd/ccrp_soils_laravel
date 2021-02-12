<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\AnalysisAgg
 *
 * @property-read \App\Models\Sample $sample
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisAgg newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisAgg newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisAgg query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $sample_id
 * @property string|null $weight_soil
 * @property string|null $weight_cloth
 * @property string|null $weight_stones2mm
 * @property string|null $weight_2mm_aggreg
 * @property string|null $weight_cloth_250micron
 * @property string|null $weight_250micron_aggreg
 * @property string|null $pct_stones
 * @property string|null $twomm_aggreg_pct
 * @property string|null $twofiftymicr_aggreg_pct
 * @property string|null $twomm_aggreg_pct_result
 * @property string|null $twofiftymicron_aggreg_pct_result
 * @property string|null $percent_stones
 * @property string|null $total_stableaggregates
 * @property string|null $total_check
 * @property string|null $validation_check
 * @property string $analysis_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $project_submission_id
 * @property-read \App\Models\ProjectSubmission $project_submission
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisAgg whereAnalysisDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisAgg whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisAgg whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisAgg wherePctStones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisAgg wherePercentStones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisAgg whereProjectSubmissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisAgg whereSampleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisAgg whereTotalCheck($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisAgg whereTotalStableaggregates($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisAgg whereTwofiftymicrAggregPct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisAgg whereTwofiftymicronAggregPctResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisAgg whereTwommAggregPct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisAgg whereTwommAggregPctResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisAgg whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisAgg whereValidationCheck($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisAgg whereWeight250micronAggreg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisAgg whereWeight2mmAggreg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisAgg whereWeightCloth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisAgg whereWeightCloth250micron($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisAgg whereWeightSoil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisAgg whereWeightStones2mm($value)
 */
	class AnalysisAgg extends \Eloquent {}
}

namespace App\Models{
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
 * @property string|null $photo
 * @property string|null $raw_conc_rounded
 * @property string|null $moisture_rounded
 * @property string|null $moisture_level_as_percentage
 * @property string|null $soil_conc_rounded
 * @property string|null $reagents
 * @property-read \App\Models\ProjectSubmission $project_submission
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisP whereMoistureLevelAsPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisP whereMoistureRounded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisP wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisP whereRawConcRounded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisP whereReagents($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisP whereSoilConcRounded($value)
 */
	class AnalysisP extends \Eloquent {}
}

namespace App\Models{
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
 * @property int $project_submission_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPh whereProjectSubmissionId($value)
 * @property-read \App\Models\ProjectSubmission $project_submission
 */
	class AnalysisPh extends \Eloquent {}
}

namespace App\Models{
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
 * @property int $project_submission_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnalysisPom whereProjectSubmissionId($value)
 * @property string|null $analysis_date
 * @property-read \App\Models\ProjectSubmission $project_submission
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisPom whereAnalysisDate($value)
 */
	class AnalysisPom extends \Eloquent {}
}

namespace App\Models{
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
 * @property string|null $photo
 * @property string|null $pct_reduction_color
 * @property-read \App\Models\ProjectSubmission $project_submission
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisPoxc wherePctReductionColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnalysisPoxc wherePhoto($value)
 */
	class AnalysisPoxc extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Contactus
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $name
 * @property string|null $email
 * @property string|null $message
 * @method static \Illuminate\Database\Eloquent\Builder|Contactus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contactus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contactus query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contactus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contactus whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contactus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contactus whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contactus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contactus whereUpdatedAt($value)
 */
	class Contactus extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DataMap
 *
 * @property string $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Xlsform[] $xls_forms
 * @property-read int|null $xls_forms_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DataMap newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DataMap newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DataMap query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DataMap whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DataMap whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DataMap whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DataMap whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property array|null $variables
 * @property string|null $model
 * @property int $location
 * @method static \Illuminate\Database\Eloquent\Builder|DataMap whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataMap whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataMap whereVariables($value)
 */
	class DataMap extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FarmerField
 *
 * @property int $id
 * @property int $project_submission_id
 * @property string $uuid
 * @property string $country_id
 * @property string $village_community
 * @property string $farmer_name
 * @property string $size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $project_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\NutrientBalance[] $nutrient_balances
 * @property-read int|null $nutrient_balances_count
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\ProjectSubmission $project_submission
 * @method static \Illuminate\Database\Eloquent\Builder|FarmerField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FarmerField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FarmerField query()
 * @method static \Illuminate\Database\Eloquent\Builder|FarmerField whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FarmerField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FarmerField whereFarmerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FarmerField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FarmerField whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FarmerField whereProjectSubmissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FarmerField whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FarmerField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FarmerField whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FarmerField whereVillageCommunity($value)
 */
	class FarmerField extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Invite
 *
 * @property int $id
 * @property string $email
 * @property int $inviter_id
 * @property int $project_id
 * @property string $key_confirm
 * @property int $is_confirmed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereInviterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereIsConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereKeyConfirm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invite whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $invite_day
 * @property-read \App\Models\User $inviter
 * @property-read \App\Models\Project $project
 * @property string $token
 * @method static \Illuminate\Database\Eloquent\Builder|Invite whereToken($value)
 */
	class Invite extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\NutrientBalance
 *
 * @property int $id
 * @property int $farmer_field_id
 * @property string $year
 * @property string $tot_org_Ninput
 * @property string $tot_org_Pinput
 * @property string $tot_org_Kinput
 * @property string $tot_inorg_Ninput
 * @property string $tot_inorg_Pinput
 * @property string $tot_inorg_Kinput
 * @property string $Total_cropNexport
 * @property string $Total_cropPexport
 * @property string $Total_cropKexport
 * @property string $balance_N
 * @property string $balance_P
 * @property string $balance_K
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $project_id
 * @property-read \App\Models\FarmerField $farmer_field
 * @property-read \App\Models\Project $project
 * @method static \Illuminate\Database\Eloquent\Builder|NutrientBalance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NutrientBalance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NutrientBalance query()
 * @method static \Illuminate\Database\Eloquent\Builder|NutrientBalance whereBalanceK($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NutrientBalance whereBalanceN($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NutrientBalance whereBalanceP($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NutrientBalance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NutrientBalance whereFarmerFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NutrientBalance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NutrientBalance whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NutrientBalance whereTotInorgKinput($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NutrientBalance whereTotInorgNinput($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NutrientBalance whereTotInorgPinput($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NutrientBalance whereTotOrgKinput($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NutrientBalance whereTotOrgNinput($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NutrientBalance whereTotOrgPinput($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NutrientBalance whereTotalCropKexport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NutrientBalance whereTotalCropNexport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NutrientBalance whereTotalCropPexport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NutrientBalance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NutrientBalance whereYear($value)
 */
	class NutrientBalance extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Project
 *
 * @property int $id
 * @property int $creator_id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $avatar
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $share_data
 * @property-read mixed $admins
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sample[] $samples
 * @property-read int|null $samples_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Submission[] $submissions
 * @property-read int|null $submissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Xlsform[] $xls_forms
 * @property-read int|null $xls_forms_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereShareData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Project withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Invite[] $invites
 * @property-read int|null $invites_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProjectXlsform[] $project_xlsforms
 * @property-read int|null $project_xlsforms_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Views\SampleMerged[] $samples_merged
 * @property-read int|null $samples_merged_count
 * @property array|null $identifiers
 * @property string $merged_view
 * @property int $highR does this project want split LR and HR results for the Olsen P analysis?
 * @property int $customR does this project want extra output columns for Custom R resutls for the Olsen P analysis?
 * @property-read \App\Models\User $creator
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCustomR($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereHighR($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereIdentifiers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereMergedView($value)
 */
	class Project extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProjectSubmission
 *
 * @property int $id
 * @property string $uuid
 * @property string $submitted_at
 * @property int $project_xlsform_id
 * @property mixed $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ProjectXlsform $project_xlsform
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectSubmission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectSubmission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectSubmission query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectSubmission whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectSubmission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectSubmission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectSubmission whereProjectXlsformId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectSubmission whereSubmittedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectSubmission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectSubmission whereUuid($value)
 * @mixin \Eloquent19
 * @property int $project_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AnalysisAgg[] $analysis_agg
 * @property-read int|null $analysis_agg_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AnalysisP[] $analysis_p
 * @property-read int|null $analysis_p_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AnalysisPh[] $analysis_ph
 * @property-read int|null $analysis_ph_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AnalysisPom[] $analysis_pom
 * @property-read int|null $analysis_pom_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AnalysisPoxc[] $analysis_poxc
 * @property-read int|null $analysis_poxc_count
 * @property-read \App\Models\Project $project
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectSubmission whereProjectId($value)
 */
	class ProjectSubmission extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProjectXlsform
 *
 * @property int $id
 * @property int $project_id
 * @property int $xlsform_id
 * @property string|null $kobo_version_id
 * @property int $records
 * @property string|null $kobo_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $project
 * @property-read int|null $project_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Xlsform[] $xls_form
 * @property-read int|null $xls_form_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectXlsform newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectXlsform newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectXlsform query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectXlsform whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectXlsform whereDeployed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectXlsform whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectXlsform whereKoboId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectXlsform whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectXlsform whereRecords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectXlsform whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectXlsform whereXlsformId($value)
 * @mixin \Eloquent
 * @property int $processing If true, this entire entry should not be editable
 * @property int $is_active If true, this project-form is deployed and active on Kobotoolbox
 * @property string|null $enketo_url If null; for mis not currently deployed/active on Kobo
 * @property-read mixed $title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProjectSubmission[] $project_submissions
 * @property-read int|null $project_submissions_count
 * @property-read \App\Models\Xlsform $xlsform
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectXlsform whereEnketoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectXlsform whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectXlsform whereKoboVersionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProjectXlsform whereProcessing($value)
 * @property string|null $kobo_media array of media ids for any media attachments to this file on kobotoolbox. Required to allow easy deletion of files when new versions are uploaded
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectXlsform whereKoboMedia($value)
 */
	class ProjectXlsform extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\QrCode
 *
 * @property int $id
 * @property string $code
 * @property string|null $farm_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrCode whereFarmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrCode whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrCode whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class QrCode extends \Eloquent {}
}

namespace App\Models{
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
 * @property int|null $plot_id
 * @property int $project_submission_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AnalysisAgg[] $analysis_agg
 * @property-read int|null $analysis_agg_count
 * @property-read mixed $p_result
 * @property-read mixed $ph_result
 * @property-read mixed $pom_result
 * @property-read \App\Models\Views\SampleMerged|null $samples_merged
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sample wherePlotId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sample whereProjectSubmissionId($value)
 * @property array|null $identifiers
 * @property string|null $simple_texture
 * @property int|null $ball_yn
 * @property int|null $ribbon_yn
 * @property string|null $ribbon_break_length
 * @property string|null $usda_gritty
 * @property string|null $final_texture_type_usda
 * @property string|null $second_texture_type_usda
 * @property int|null $ball_yn_fao
 * @property int|null $sausage_yn_fao
 * @property int|null $pencil_fao_yn
 * @property int|null $halfcircle_fao_yn
 * @property string|null $soil_circle_choice
 * @property string|null $final_texture_type_fao
 * @property string|null $second_texture_type_fao
 * @property-read mixed $custom_r_p_result
 * @property-read mixed $hr_p_result
 * @property-read mixed $lr_p_result
 * @property-read mixed $pom_diameter
 * @property-read mixed $pom_percent
 * @property-read mixed $total_stableaggregates
 * @property-read mixed $twofiftymicron_aggreg_pct_result
 * @property-read mixed $twomm_aggreg_pct_result
 * @property-read \App\Models\ProjectSubmission $project_submission
 * @method static \Illuminate\Database\Eloquent\Builder|Sample whereBallYn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sample whereBallYnFao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sample whereFinalTextureTypeFao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sample whereFinalTextureTypeUsda($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sample whereHalfcircleFaoYn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sample whereIdentifiers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sample wherePencilFaoYn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sample whereRibbonBreakLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sample whereRibbonYn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sample whereSausageYnFao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sample whereSecondTextureTypeFao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sample whereSecondTextureTypeUsda($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sample whereSimpleTexture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sample whereSoilCircleChoice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sample whereUsdaGritty($value)
 */
	class Sample extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Submission
 *
 * @property int $id
 * @property string $uuid
 * @property int $project_id
 * @property int $xlsform_id
 * @property mixed $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\Xlsform $xls_form
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission whereXlsformId($value)
 * @mixin \Eloquent
 * @property string $submitted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission whereSubmittedAt($value)
 */
	class Submission extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $avatar
 * @property string|null $kobo_id
 * @property bool $admin
 * @property string $slug
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @property-read int|null $projects_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereKoboId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects_with_admin_role
 * @property-read int|null $projects_with_admin_role_count
 */
	class User extends \Eloquent {}
}

namespace App\Models\Views{
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
 * @property string|null $simple_texture
 * @property int|null $ball_yn
 * @property int|null $ribbon_yn
 * @property string|null $ribbon_break_length
 * @property string|null $usda_gritty
 * @property string|null $final_texture_type_usda
 * @property string|null $second_texture_type_usda
 * @property int|null $ball_yn_fao
 * @property int|null $sausage_yn_fao
 * @property int|null $pencil_fao_yn
 * @property int|null $halfcircle_fao_yn
 * @property string|null $soil_circle_choice
 * @property string|null $final_texture_type_fao
 * @property string|null $second_texture_type_fao
 * @property string|null $analysis_p-raw_conc_rounded
 * @property string|null $analysis_p-moisture_rounded
 * @property string|null $analysis_p-moisture_level_as_percentage
 * @property string|null $analysis_p-soil_conc_rounded
 * @property string|null $analysis_poxc-pct_reduction_color
 * @property string|null $analysis_pom-weight_soil
 * @property string|null $analayis_pom-diameter_circ_pom
 * @property int|null $analayis_pom-weigh_pom_yn
 * @property string|null $analayis_pom-weight_cloth
 * @property string|null $analayis_pom-weight_pom
 * @property string|null $analayis_pom-percent_pom
 * @property string|null $analayis_pom-analysis_date
 * @property string|null $analysis_agg-weight_soil
 * @property string|null $analysis_agg-weight_cloth
 * @property string|null $analysis_agg-weight_stones2mm
 * @property string|null $analysis_agg-weight_2mm_aggreg
 * @property string|null $analysis_agg-weight_cloth_250micron
 * @property string|null $analysis_agg-weight_250micron_aggreg
 * @property string|null $analysis_agg-pct_stones
 * @property string|null $analysis_agg-twomm_aggreg_pct
 * @property string|null $analysis_agg-twofiftymicr_aggreg_pct
 * @property string|null $analysis_agg-twomm_aggreg_pct_result
 * @property string|null $analysis_agg-twofiftymicron_aggreg_pct_result
 * @property string|null $analysis_agg-percent_stones
 * @property string|null $analysis_agg-total_stableaggregates
 * @property string|null $analysis_agg-total_check
 * @property string|null $analysis_agg-validation_check
 * @property string|null $analysis_agg-analysis_date
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalayisPomAnalysisDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalayisPomDiameterCircPom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalayisPomPercentPom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalayisPomWeighPomYn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalayisPomWeightCloth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalayisPomWeightPom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalysisAggAnalysisDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalysisAggPctStones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalysisAggPercentStones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalysisAggTotalCheck($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalysisAggTotalStableaggregates($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalysisAggTwofiftymicrAggregPct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalysisAggTwofiftymicronAggregPctResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalysisAggTwommAggregPct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalysisAggTwommAggregPctResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalysisAggValidationCheck($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalysisAggWeight250micronAggreg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalysisAggWeight2mmAggreg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalysisAggWeightCloth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalysisAggWeightCloth250micron($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalysisAggWeightSoil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalysisAggWeightStones2mm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalysisPMoistureLevelAsPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalysisPMoistureRounded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalysisPRawConcRounded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalysisPSoilConcRounded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalysisPomWeightSoil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereAnalysisPoxcPctReductionColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereBallYn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereBallYnFao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereFinalTextureTypeFao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereFinalTextureTypeUsda($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereHalfcircleFaoYn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged wherePencilFaoYn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereRibbonBreakLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereRibbonYn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereSausageYnFao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereSecondTextureTypeFao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereSecondTextureTypeUsda($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereSimpleTexture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereSoilCircleChoice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SampleMerged whereUsdaGritty($value)
 */
	class SampleMerged extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Xlsform
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $file
 * @property string $version
 * @property string|null $kobo_version_id
 * @property string|null $instance_name
 * @property string|null $link_page
 * @property string|null $description
 * @property array|null $media
 * @property mixed|null $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @property-read int|null $projects_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Submission[] $submissions
 * @property-read int|null $submissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Variable[] $variables
 * @property-read int|null $variables_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereDefaultLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereFormTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereInstanceName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereLinkPage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereMedia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform wherePathFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereVersionId($value)
 * @mixin \Eloquent
 * @property string|null $xlsfile
 * @property string|null $kobo_id
 * @property int $live If true, this form is available to projects to use
 * @property string|null $enketo_url
 * @property int $is_active If true, the form is active on Kobotools
 * @property string $data_map_id
 * @property-read \App\Models\DataMap $data_map
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProjectXlsform[] $project_xlsforms
 * @property-read int|null $project_xlsforms_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereDataMapId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereEnketoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereKoboId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereKoboVersionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereLive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Xlsform whereXlsfile($value)
 * @property string|null $kobo_media array of media ids for any media attachments to this file on kobotoolbox. Required to allow easy deletion of files when new versions are uploaded
 * @property int $public If true, the form is automatically available to all projects
 * @property int|null $project_id if form is private, which project is it linked to?
 * @property array|null $extra_data
 * @property-read \App\Models\Project|null $private_project
 * @method static \Illuminate\Database\Eloquent\Builder|Xlsform whereExtraData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xlsform whereKoboMedia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xlsform whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Xlsform wherePublic($value)
 */
	class Xlsform extends \Eloquent {}
}

