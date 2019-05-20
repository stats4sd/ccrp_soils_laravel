<?php

use Illuminate\Database\Seeder;

class XlsformTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('xls_forms')->insert(array(
        	array(
        		'form_title' => 'CCRP Soil Sampling - Intake Form',
        		'form_id' => 'ccrp_soil_intake',
        		'default_language' => 'English',
        		'version' => now(),
        		'instance_name' => 'concat("date: ", ${today}, "; farmer:", ${farmer},"; sample_id: ",${sample_id})'
        	),
        	array(
        		'form_title' => 'CCRP Soil Analysis - POXC Form',
        		'form_id' => 'ccrp_soil_poxc',
        		'default_language' => 'English',
        		'version' => now(),
        		'instance_name' => 'concat("POXC Analysis - Date: ",${analysis_date}," - Sample Code: ",${sample_id})'
        	),
        	array(
        		'form_title' => 'CCRP Soil Analysis - pH Form',
        		'form_id' => 'ccrp_soil_ph',
        		'default_language' => 'English',
        		'version' => now(),
        		'instance_name' => 'concat("pH Analysis - Date: ",${analysis_date}," - Sample Code: ",${sample_id})'
        	),
        	array(
        		'form_title' => 'CCRP Soil Analysis - P Form',
        		'form_id' => 'ccrp_soil_p',
        		'default_language' => 'English',
        		'version' => now(),
        		'instance_name' => 'concat("Soil P Analysis - Date: ",${analysis_date}," - Sample Code: ",${sample_id})'
        	),
        	array(
        		'form_title' => 'CCRP Soil Analysis - Aggregates',
        		'form_id' => 'ccrp_soil_agg',
        		'default_language' => 'English',
        		'version' => now(),
        		'instance_name' => 'concat("Soil_aggregate_stability - Date: ",${analysis_date}," - Sample Code: ",${sample_id})'
        	),
        ));
    }
}