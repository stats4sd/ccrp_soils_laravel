<?php

namespace App\Exports;

use App\Models\Sample;
use App\Models\Project;
use App\Models\AnalysisAgg;
use App\Models\AnalysisPom;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AnalysisPomExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    private $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function title(): string
    {
        return 'Analysis POM';
    }


    public function collection()
    {
        return AnalysisPom::whereHas('sample', function (Builder $query) {
            $query->where('project_id', $this->project->id);
        })->get();
    }

    public function map($analysis): array
    {
        return [
            $analysis->sample_id,
            $analysis->analysis_date,
            $analysis->weight_soil,
            $analysis->diameter_circ_pom,
            $analysis->weigh_pom_yn,
            $analysis->weight_cloth,
            $analysis->weight_pom,
            $analysis->percent_pom,
        ];
    }


    public function headings(): array
    {
        return [
            'sample_id',
            'analysis_date',
            'weight_soil',
            'diameter_circ_pom',
            'weigh_pom_yn',
            'weight_cloth',
            'weight_pom',
            'percent_pom',
        ];
    }
}
