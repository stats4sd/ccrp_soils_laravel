<?php

namespace App\Exports;

use App\Models\Sample;
use App\Models\Project;
use App\Models\AnalysisAgg;
use App\Models\AnalysisP;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AnalysisPExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    private $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function title(): string
    {
        return 'Analysis Olsen P';
    }


    public function collection()
    {
        return AnalysisP::whereHas('sample', function (Builder $query) {
            $query->where('project_id', $this->project->id);
        })->get();
    }

    public function map($analysis): array
    {
        return [
            $analysis->sample_id,
            $analysis->analysis_date,
            $analysis->weight_soil,
            $analysis->vol_extract,
            $analysis->vol_topup,
            $analysis->color,
            $analysis->cloudy,
            $analysis->photo,
            $analysis->blank_water,
            $analysis->raw_conc,
            $analysis->correct_moisture,
            $analysis->moisture,
            $analysis->raw_conc_rounded,
            $analysis->moisture_rounded,
            $analysis->moisture_level_as_percentage,
            $analysis->soil_conc_rounded,
            $analysis->olsen_p,
            $analysis->olsen_p_corrected,
            $analysis->reagents,
        ];
    }


    public function headings(): array
    {
        return [
            'sample_id',
            'analysis_date',
            'weight_soil',
            'vol_extract',
            'vol_topup',
            'color',
            'cloudy',
            'photo',
            'blank_water',
            'raw_conc',
            'correct_moisture',
            'moisture',
            'raw_conc_rounded',
            'moisture_rounded',
            'moisture_level_as_percentage',
            'soil_conc_rounded',
            'olsen_p',
            'olsen_p_corrected',
            'reagents',
        ];
    }
}
