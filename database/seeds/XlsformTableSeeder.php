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
        		'title' => 'Sampling Intake Process',
        		'form_id' => '',
        		'version' => today(),
        		'instance_name' => '',
                'link_page' => '',
                'description' => 'There are 2 versions of the intake form available. The first is a “quick” version – this form is ready-to-go, but does not include any customisation for entering your own community lists.
                    The second is a version that allows you to add your own community listing. This is designed to be used with this platform’s location management, but it is also a good template if you want to use it with your own project’s data management system. This version requires you to edit the XLS form by adding the choice lists for the communities and farmers that you work with.',
        	),
        	array(
        		'title' => 'Analysis Forms',
        		'form_id' => 'ccrp_soil_poxc',
        		'version' => today(),
        		'instance_name' => '',
                'link_page' => '',
                'description' => 'The following forms are available to assist with data entry and calculations during the analysis. These forms are designed to be used with the above intake form, and require you to have a QR code attached to each sample for identification purposes.',
        	),
        	array(
        		'title' => 'Active carbon',
        		'form_id' => 'ccrp_soil_ph',
        		'version' => today(),
        		'instance_name' => '',
                'link_page' => 'https://smallholder-sha.org/protocol-1/active-carbon/',
                'description' => '',
        	),
        	array(
        		'title' => 'Soil pH',
        		'form_id' => 'ccrp_soil_p',
        		'version' => today(),
        		'instance_name' => '',
                'link_page' => 'https://smallholder-sha.org/protocol-1/soil_ph/',
                'description' => '',
        	),
        	array(
        		'title' => 'Available Phosphorus',
        		'form_id' => 'ccrp_soil_agg',
        		'version' => today(),
        		'instance_name' => '',
                'link_page' => 'https://smallholder-sha.org/protocol-1/available-phosphorus/',
                'description' => '',
        	),
        ));
    }
}
