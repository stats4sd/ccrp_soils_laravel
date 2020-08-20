<?php

namespace App\Exports;

use App\Models\Project;
use App\Models\Views\SampleMerged;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SampleMergedExport implements FromCollection, WithHeadings, ShouldAutoSize
{

    use Exportable;

    public function forProject (Project $project)
    {
       $this->project = $project;
       return $this;
    }

    public function headings (): array
    {
       return array_keys(SampleMerged::first()->toArray());
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table($this->project->merged_view)
            ->where('project_id', $this->project->id)
            ->orderBy('sample_id','asc')
            ->get();
    }
}
