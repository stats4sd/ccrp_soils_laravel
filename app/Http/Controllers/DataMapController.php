<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sample;
use App\Models\DataMap;
use App\Models\Project;
use App\Models\Xlsform;
use App\Models\AnalysisP;
use App\Models\AnalysisPh;
use App\Models\AnalysisAgg;
use App\Models\AnalysisPom;
use App\Models\AnalysisPoxc;
use Illuminate\Http\Request;
use App\Models\ProjectXlsform;
use App\Models\ProjectSubmission;
use Illuminate\Support\Facades\Log;
use App\Events\NewDataVariableSpotted;
use App\Helpers\GenericHelper;
use App\Jobs\ImportAttachmentFromKobo;

class DataMapController extends Controller
{
    public static function newRecord(DataMap $dataMap, array $data, Int $projectId = null)
    {
        $newModel = [
            "project_submission_id" => $data['_id'],
        ];

        // handle sample ID
        if ($dataMap->id == 'sample') {
            $newModel['project_id'] = $projectId ?: null;
            $newModel['id'] = isset($data['sample_id']) ? $data['sample_id'] : null;

            Log::info("dealing with identifiers");
            Log::info($projectId);

            if ($projectId) {
                $project = Project::find($projectId);

                if (is_array($project->identifiers)) {
                    foreach ($project->identifiers as $identifier) {
                        $newModel['identifiers'][$identifier['name']] = isset($data[$identifier['name']]) ? $data[$identifier['name']] : null;
                    }
                }
            }
        } else {
            $newModel['sample_id'] = isset($data['sample_id']) ? $data['sample_id'] : $data['no_bar_code'];
        }


        if ($dataMap->location) {
            if (isset($data['gps_coordinates']) && $data['gps_coordinates']) {
                $location = explode(" ", $data['gps_coordinates']);
            } elseif (isset($data['_geolocation']) && $data['_geolocation']) {
                $location = $data['_geolocation'];
            }
            if ($location) {
                $newModel["longitude"] = isset($location[1]) ? $location[1] : null;
                $newModel["latitude"] = isset($location[0]) ? $location[0] : null;
                $newModel["altitude"] = isset($location[2]) ? $location[2] : null;
                $newModel["accuracy"] = isset($location[3]) ? $location[3] : null;
            }
        }

        foreach ($dataMap->variables as $variable) {

            // if the variable is new (i.e. hasn't been manually added to the database)
            if ($variable['in_db'] == 0) {
                //don't actually process it (as the SQL Insert will fail)
                //just tell the admin about it!
                NewDataVariableSpotted::dispatch($variable['name']);
                continue;
            }

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
                    if (isset($data[$variableName]) && $data[$variableName]) {
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

            if (!is_null($value)) {
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

    public function updateAllRecords(Xlsform $xlsform)
    {
        $projectFormIds = $xlsform->project_xlsforms->pluck('id');


        $submissions = ProjectSubmission::whereIn('project_xlsform_id', $projectFormIds)
        ->get();

        $dataMap = $xlsform->data_map;

        foreach ($submissions as $submission) {
            $model = 'App\\Models\\'.$dataMap->model;

            $model::where('project_submission_id', '=', $submission->id)
            ->delete();

            $content = GenericHelper::remove_group_names_from_kobo_data(json_decode($submission->content, true));
            Log::info($content);

            $this->newRecord($dataMap, $content, $submission->project_xlsform->project->id);
        }

        return count($submissions);
    }
}
