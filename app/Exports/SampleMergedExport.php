<?php

namespace App\Exports;

use App\Models\Views\SampleMerged;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SampleMergedExport implements FromCollection, WithHeadings, ShouldAutoSize
{

    use Exportable;

    public function forProject (int $projectId)
    {
       $this->projectId = $projectId;
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
        return SampleMerged::where('project_id', $this->projectId)
        ->orderBy('sample_id','asc')->get();
    }
}
