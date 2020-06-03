<?php

use App\Models\DataMap;
use Illuminate\Database\Seeder;

class DataMapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataMap::create([
            'id' => 'sample',
            'name' => 'Sample Intake',
        ]);

        DataMap::create([
            'id' => 'analysis_agg',
            'name' => 'Analysis Aggregates',
        ]);

        DataMap::create([
            'id' => 'analysis_p',
            'name' => 'Analysis P',
        ]);

        DataMap::create([
            'id' => 'analysis_ph',
            'name' => 'Analysis pH',
        ]);

        DataMap::create([
            'id' => 'analysis_pom',
            'name' => 'Analysis Particulate Organic Matter',
        ]);

        DataMap::create([
            'id' => 'analysis_poxc',
            'name' => 'Analysis POXC',
        ]);
    }
}
