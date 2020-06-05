<?php

namespace App\Exports;

use App\Models\Submission;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SubmissionExport implements FromCollection, WithHeadings, ShouldAutoSize
{

    use Exportable;

    public function forForm(int $formId)
    {
        $this->formId = $formId;
        return $this;
    }

    public function headings(): array
    {
        // Get keys from the 'content' JSON of first submission, and hope that all submissions follow the same structure...
        // THIS WILL FAIL if the form structure changes after the first submission!!
        $submission = collect(json_decode(Submission::first()->pluck('content')[0]))->toArray();

        return array_keys($submission);
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $submissions = Submission::where('xlsform_id', $this->formId)->get();
        $data = [];
        foreach($submissions as $submission) {
            $data[] = json_decode($submission->content);
        }

        return collect($data);
    }
}
