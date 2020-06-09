<div class="container mt-4">
    Number of soil samples in database: <b> {{ $project->samples->count() }}</b>
</div>
<div class="row">
    <div class="col-md-6">
        <table class="table table-striped table-bordered">
            <tr>
                <th>Sample Id</th>
                <th>POXC Value (Moisture Corrected if available)</th>
                <th>P Value</th>
                <th>pH Value</th>
                <th>POM Value</th>
                <th>Total Stable Aggregates</th>
                <th>2mm Agg PCT Result</th>
                <th>250 micron Agg PCT Result</th>
                <th>% Stones</th>
            </tr>
            @foreach($project->samples as $sample)
            <tr>
                <td>{{ $sample->id }}</td>
                <td>{{ $sample->poxc_result }}</td>
                <td>{{ $sample->p_result }}</td>
                <td>{{ $sample->ph_result }}</td>
                <td>{{ $sample->pom_result }}</td>
                <td>{{ $sample->total_stableaggregates }}</td>
                <td>{{ $sample->twomm_aggreg_pct_result }}</td>
                <td>{{ $sample->twofiftymicron_aggreg_pct_result }}</td>
                <td>{{ $sample->percent_stones }}</td>
            </tr>
            @endforeach
        </table>

    </div>
</div>
<a href="{{ route('projects.downloadsamples', $project) }}" class="btn btn-info">Download Merged Sample Data</a>