<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SamplesMergedController extends Controller
{
    public function download()
    {
        $scriptName = 'samples_merged_csv.py';
        $scriptPath = base_path() . '/scripts/' . $scriptName;
        $base_path = base_path();
        $file_name = date('c')."samplesMerged.csv";
      
        //python script accepts 4 arguments in this order: base_path(), query, params and file name
       
        $process = new Process("python3.7 {$scriptPath} {$base_path} {$file_name}");

        $process->run();
        
        if(!$process->isSuccessful()) {
            
           throw new ProcessFailedException($process);
        
        } else {
            
            $process->getOutput();
        }
        Log::info("python done.");
        Log::info($process->getOutput());

        $path_download =  Storage::url('/data/'.$file_name);
        return response()->json(['path' => $path_download]);
    }
}
