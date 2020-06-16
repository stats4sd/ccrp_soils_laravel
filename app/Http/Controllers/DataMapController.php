<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sample;
use App\Models\DataMap;
use App\Models\AnalysisP;
use App\Models\AnalysisPh;
use App\Models\AnalysisAgg;
use App\Models\AnalysisPom;
use App\Models\AnalysisPoxc;
use Illuminate\Http\Request;
use App\Jobs\ImportAttachmentFromKobo;
use App\Models\ProjectSubmission;

class DataMapController extends Controller
{

    public static function newRecord(DataMap $dataMap, Array $data, Int $projectId = null)
    {
        $newModel = [
            "project_submission_id" => $data['_id'],
        ];

        // handle sample ID
        if($dataMap->id == 'sample') {
            $newModel['project_id'] = $projectId ?: null;
            $newModel['id'] = isset($data['sample_id']) ? $data['sample_id'] : $data['no_bar_code'];
        }
        else {
            $newModel['sample_id'] = isset($data['sample_id']) ? $data['sample_id'] : $data['no_bar_code'];
        }



        if($dataMap->has_location && isset($data['location']) && $data['location']) {
            $location = explode(" ", $data['location']);
            $newModel["longitude"] = isset($location[1]) ? $location[1] : null;
            $newModel["latitude"] = isset($location[0]) ? $location[0] : null;
            $newModel["altitude"] = isset($location[2]) ? $location[2] : null;
            $newModel["accuracy"] = isset($location[3]) ? $location[3] : null;
        }

        foreach($dataMap->variables as $variable) {
            $variableName = $variable['name'];
            $value = null;

            switch ($variable['type']) {
                case 'boolean':
                    if (isset($data[$variableName]) && $data[$variableName]) {
                        switch ($data[$variableName]) {
                            case 'yes':
                                $value = 1;
                            break;

                            case 'no':
                                $value = 0;
                            break;

                            case "1":
                            case "0":
                                $value = $data[$variableName];
                            break;
                            // error handling in a painfully basic way - set any unhandled values to null;
                            default:
                                $value = null;
                            break;
                        }
                    }
                break;

                case 'photo':
                    if(isset($data[$variableName]) && $data[$variableName]) {
                        $value = $data[$variableName];
                        ImportAttachmentFromKobo::dispatch($value, $data);
                    }
                break;

                case 'date':
                    if (isset($data[$variableName]) && $data[$variableName]) {
                        $value = Carbon::parse($data[$variableName]);
                        $value = $value->toDateString();
                    }
                break;

                case 'datetime':
                    if (isset($data[$variableName]) && $data[$variableName]) {
                        $value = Carbon::parse($data[$variableName]);
                        $value = $value->toDateTimeString();
                    }
                break;

                case 'select_multiple':
                case 'geopoint':
                    $value = null;
                break;

                default:
                    $value = isset($data[$variableName]) ? $data[$variableName] : null;
                break;
            }

            if(!is_null($value)) {
                $newModel[$variableName] = $value;
            }
        }

        $class = 'App\\Models\\'.$dataMap->model;
        $newItem = new $class();

        $newItem->fill($newModel);
        $newItem->save();

        \Log::info($class . " created");
        \Log::info("values: " . json_encode($newModel));

    }

    public static function sample (Array $data, Int $submissionId, Int $projectId)
    {
        $location = null;
        if (isset($data['location']) && $data['location']) {
            $location = explode(" ", $data['location']);
        }

        if(isset($data['date']) && $data['date']) {
            dump($data['date']);
            $date = Carbon::parse($data['date']);
            $date = $date->toDateString();

        }

        //yes-no to true,false
        if(isset($data['at_plot']) && $data['at_plot']) {
            switch ($data['at_plot']) {
                case 'yes':
                    $atPlot = true;
                break;

                case 'no':
                    $atPlot = false;
                break;

                default:
                    $atPlot = $data['at_plot'];
                break;
            }
        }

        Sample::create([
            "id" => isset($data['sample_id']) ? $data['sample_id'] : $data['no_bar_code'],
            "date" => isset($date) ? $date : null,
            "depth" => isset($data['depth']) ? $data['depth'] : null,
            "texture" => isset($data['texture']) ? $data['texture'] : null,
            "at_plot" => isset($atPlot) ? $atPlot : null,
            "plot_photo" => isset($data['plot_photo']) ? $data['plot_photo'] : null,
            "longitude" => isset($location[1]) ? $location[1] : null,
            "latitude" => isset($location[0]) ? $location[0] : null,
            "altitude" => isset($location[2]) ? $location[2] : null,
            "accuracy" => isset($location[3]) ? $location[3] : null,
            "comment" => isset($data['comment']) ? $data['comment'] : null,
            "community_quick" => isset($data['na_community']) ? $data['na_community'] : null,
            "project_id" => $projectId,
            "farmer_quick" => isset($data['farmer']) ? $data['farmer'] : null,
            "project_submission_id" => $submissionId,
        ]);

        \Log::info("sample created");
    }

    public static function analysis_p($data, $submission_id)
    {
        AnalysisP::create([
            "sample_id" => isset($data['sample_id']) ? $data['sample_id'] : $data['no_bar_code'],
            "analysis_date" => isset($data['analysis_date']) ? $data['analysis_date'] : null,
            "vol_extract" => isset($data['vol_extract']) ? $data['vol_extract'] : null,
            "vol_topup" => isset($data['vol_topup']) ? $data['vol_topup'] : null,
            "cloudy" => isset($data['cloudy']) ? $data['cloudy'] : null,
            "color" => isset($data['color']) ? $data['color'] : null,
            "raw_conc" => isset($data['raw_conc']) ? $data['raw_conc'] : null,
            "olsen_p" => isset($data['olsen_p']) ? $data['olsen_p'] : null,
            "blank_water" => isset($data['blank_water']) ? $data['blank_water'] : null,
            "correct_moisture" => isset($data['correct_moisture']) ? $data['correct_moisture'] : null,
            "moisture" => isset($data['moisture']) ? $data['moisture'] : null,
            "olsen_p_corrected" => isset($data['olsen_p_corrected']) ? $data['olsen_p_corrected'] : null,
            "project_submission_id" => $submission_id ?: null,
        ]);
    }

    public static function analysis_ph($data, $submission_id)
    {
        AnalysisPh::create([
            "sample_id" => isset($data['sample_id']) ? $data['sample_id'] : $data['no_bar_code'],
            "analysis_date" => isset($data['analysis_date']) ? $data['analysis_date'] : null,
            "weight_soil" => isset($data['weight_soil']) ? $data['weight_soil'] : null,
            "vol_water" => isset($data['vol_water']) ? $data['vol_water'] : null,
            "reading_ph" => isset($data['reading_ph']) ? $data['reading_ph'] : null,
            "stability" => isset($data['stability']) ? $data['stability'] : null,
            "project_submission_id" => $submission_id ?: null,
        ]);
    }

    public static function analysis_pom($data, $submission_id)
    {
        AnalysisPom::create([
            "sample_id" => isset($data['sample_id']) ? $data['sample_id'] : $data['no_bar_code'],
            "analysis_date" => isset($data['analysis_date']) ? $data['analysis_date'] : null,
            "weight_soil" => isset($data['weight_soil']) ? $data['weight_soil'] : null,
            "diameter_circ_pom" => isset($data['diameter_circ_pom']) ? $data['diameter_circ_pom'] : null,
            "weigh_pom_yn" => isset($data['weigh_pom_yn']) ? $data['weigh_pom_yn'] : null,
            "weight_cloth" => isset($data['weight_cloth']) ? $data['weight_cloth'] : null,
            "weight_pom" => isset($data['weight_pom']) ? $data['weight_pom'] : null,
            "percent_pom" => isset($data['percent_pom']) ? $data['percent_pom'] : null,

            "project_submission_id" => $submission_id ?: null,
        ]);
    }

    public static function analysis_poxc($data, $submission_id)
    {
        AnalysisPoxc::create([
            "sample_id" => isset($data['sample_id']) ? $data['sample_id'] : $data['no_bar_code'],
            "analysis_date" => isset($data['analysis_date']) ? $data['analysis_date'] : null,
            "weight_soil" => isset($data['weight_soil']) ? $data['weight_soil'] : null,
            "color" => isset($data['color']) ? $data['color'] : null,
            "color100" => isset($data['color100']) ? $data['color100'] : null,
            "conc_digest" => isset($data['conc_digest']) ? $data['conc_digest'] : null,
            "cloudy" => isset($data['cloudy']) ? $data['cloudy'] : null,
            "colorimeter" => isset($data['colorimeter']) ? $data['colorimeter'] : null,
            "raw_conc" => isset($data['raw_conc']) ? $data['raw_conc'] : null,
            "poxc_soil" => isset($data['poxc_soil']) ? $data['poxc_soil'] : null,
            "correct_moisture" => isset($data['correct_moisture']) ? $data['correct_moisture'] : null,
            "moisture" => isset($data['moisture']) ? $data['moisture'] : null,
            "poxc_soil_corrected" => isset($data['poxc_soil_corrected']) ? $data['poxc_soil_corrected'] : null,

            "project_submission_id" => $submission_id ?: null,
        ]);
    }

    public static function analysis_agg($data, $submission_id)
    {
        AnalysisAgg::create([
            "sample_id" => isset($data['sample_id']) ? $data['sample_id'] : $data['no_bar_code'],
            "weight_soil" => isset($data['weight_soil']) ? $data['weight_soil'] : null,
            "weight_cloth" => isset($data['weight_cloth']) ? $data['weight_cloth'] : null,
            "weight_stones2mm" => isset($data['weight_stones2mm']) ? $data['weight_stones2mm'] : null,
            "weight_2mm_aggreg" => isset($data['weight_2mm_aggreg']) ? $data['weight_2mm_aggreg'] : null,
            "weight_cloth_250micron" => isset($data['weight_cloth_250micron']) ? $data['weight_cloth_250micron'] : null,
            "weight_250micron_aggreg" => isset($data['weight_250micron_aggreg']) ? $data['weight_250micron_aggreg'] : null,
            "pct_stones" => isset($data['pct_stones']) ? $data['pct_stones'] : null,
            "twomm_aggreg_pct" => isset($data['twomm_aggreg_pct']) ? $data['twomm_aggreg_pct'] : null,
            "twofiftymicr_aggreg_pct" => isset($data['twofiftymicr_aggreg_pct']) ? $data['twofiftymicr_aggreg_pct'] : null,
            "twomm_aggreg_pct_result" => isset($data['outputs/twomm_aggreg_pct_result']) ? $data['outputs/twomm_aggreg_pct_result'] : null,
            "twofiftymicron_aggreg_pct_result" => isset($data['outputs/twofiftymicron_aggreg_pct_result']) ? $data['outputs/twofiftymicron_aggreg_pct_result'] : null,
            "percent_stones" => isset($data['outputs/percent_stones']) ? $data['outputs/percent_stones'] : null,
            "total_stableaggregates" => isset($data['outputs/total_stableaggregates']) ? $data['outputs/total_stableaggregates'] : null,
            "project_submission_id" => $submission_id ?: null,
        ]);
    }


}
