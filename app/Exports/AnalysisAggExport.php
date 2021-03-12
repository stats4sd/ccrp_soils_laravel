<?php

namespace App\Exports;

use App\Models\Sample;
use App\Models\Project;
use App\Models\AnalysisAgg;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AnalysisAggExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    private $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function title(): string
    {
        return 'Analysis Aggregates';
    }


    public function collection()
    {
        return AnalysisAgg::whereHas('sample', function (Builder $query) {
            $query->where('project_id', $this->project->id);
        })->get();
    }

    public function map($analysis): array
    {
        return [
            $analysis->sample_id,
            $analysis->weight_soil,
            $analysis->weight_cloth,
            $analysis->weight_stones2mm,
            $analysis->weight_2mm_aggreg,
            $analysis->weight_cloth_250micron,
            $analysis->weight_250micron_aggreg,
            $analysis->pct_stones,
            $analysis->twomm_aggreg_pct,
            $analysis->twofiftymicr_aggreg_pct,
            $analysis->twomm_aggreg_pct_result,
            $analysis->twofiftymicron_aggreg_pct_result,
            $analysis->percent_stones,
            $analysis->total_stableaggregates,
            $analysis->total_check,
            $analysis->validation_check,
            $analysis->analysis_date,
        ];
    }


    public function headings(): array
    {
        return [
            'sample_id',
            'weight_soil',
            'weight_cloth',
            'weight_stones2mm',
            'weight_2mm_aggreg',
            'weight_cloth_250micron',
            'weight_250micron_aggreg',
            'pct_stones',
            'twomm_aggreg_pct',
            'twofiftymicr_aggreg_pct',
            'twomm_aggreg_pct_result',
            'twofiftymicron_aggreg_pct_result',
            'percent_stones',
            'total_stableaggregates',
            'total_check',
            'validation_check',
            'analysis_date',
        ];
    }
}
