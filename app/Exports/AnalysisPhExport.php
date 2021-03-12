<?php

namespace App\Exports;

use App\Models\Sample;
use App\Models\Project;
use App\Models\AnalysisAgg;
use App\Models\AnalysisPh;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AnalysisPhExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    private $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function title(): string
    {
        return 'Analysis Ph';
    }


    public function collection()
    {
        return AnalysisPh::whereHas('sample', function (Builder $query) {
            $query->where('project_id', $this->project->id);
        })->get();
    }

    public function map($analysis): array
    {
        return [
            $analysis->sample_id,
            $analysis->analysis_date,
            $analysis->weight_soil,
            $analysis->vol_water,
            $analysis->reading_ph,
            $analysis->stability,
        ];
    }


    public function headings(): array
    {
        return [
            'sample_id',
            'analysis_date',
            'weight_soil',
            'vol_water',
            'reading_ph',
            'stability',
        ];
    }
}
