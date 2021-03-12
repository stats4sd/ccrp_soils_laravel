<?php

namespace App\Exports;

use App\Models\Sample;
use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class SampleExport implements FromQuery, WithHeadings, WithMapping, WithTitle
{
    private $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function title(): string
    {
        return 'Samples';
    }



    /**
    * @return \Illuminate\Support\Query
    */
    public function query()
    {
        return Sample::where('project_id', $this->project->id);
    }

    public function map($sample): array
    {
        return [
            $sample->id,
            $sample->date,
            $sample->depth,
            $sample->at_plot,
            $sample->longitude,
            $sample->latitude,
            $sample->altitude,
            $sample->accuracy,
            $sample->plot_photo,
            $sample->comment,
            $sample->simple_texture,
            $sample->ball_yn,
            $sample->ribbon_yn,
            $sample->ribbon_break_length,
            $sample->usda_gritty,
            $sample->final_texture_type_usda,
            $sample->second_texture_type_usda,
            $sample->ball_yn_fao,
            $sample->sausage_yn_fao,
            $sample->pencil_fao_yn,
            $sample->halfcircle_fao_yn,
            $sample->soil_circle_choice,
            $sample->final_texture_type_fao,
            $sample->second_texture_type_fao,
        ];
    }


    public function headings(): array
    {
        return [
            'sample_id',
            'date',
            'depth',
            'at_plot',
            'longitude',
            'latitude',
            'altitude',
            'accuracy',
            'plot_photo',
            'comment',
            'simple_texture',
            'ball_yn',
            'ribbon_yn',
            'ribbon_break_length',
            'usda_gritty',
            'final_texture_type_usda',
            'second_texture_type_usda',
            'ball_yn_fao',
            'sausage_yn_fao',
            'pencil_fao_yn',
            'halfcircle_fao_yn',
            'soil_circle_choice',
            'final_texture_type_fao',
            'second_texture_type_fao',
        ];
    }
}
