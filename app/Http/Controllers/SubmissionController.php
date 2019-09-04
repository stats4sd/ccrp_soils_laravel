<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;


class SubmissionController extends Controller
{
    public function download ($en, $id)
    {
        $submissions = Submission::where('project_id', '=', $id)->get();

        //filter out unwanted junk from data
        $filter = [
            'end',
            'start',
            'deviceid',
            'username',
            'formhub/uuid',
            'meta/instanceID',
            'meta/instanceName',
            '_id',
            '_tags',
            '_uuid',
            '_notes',
            '_status',
            'na_today',
            '__version__',
            '_attachments',
            '_geolocation',
            '_submitted_by',
            '_submission_time',
            '_xform_id_string',
            '_bamboo_dataset_id',
            '_validation_status',
        ];

        foreach($submissions as $submission) {
            $data = json_decode($submission->content);
            //dd($data);
            //before removing un-needed properties, deal with attachments and geolocation

            if($data->_geolocation[0] != null) {
                $data->location = implode(' ', $data->location);
                $data->latitude = $data->location[0];
                $data->longitude = $data->location[1];
                $data->altitude = $data->location[2];
                $data->accuracy = $data->location[3];
                unset($data->location);
            }


            foreach($filter as $key) {
                unset($data->$key);
            }


        }

     
    }
}
