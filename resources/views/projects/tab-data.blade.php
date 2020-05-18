<div class="container mt-4">
    Number of soil samples in database: <b> {{ $project->samples->count() }}</b>
</div>
<div class="row">
    <div class="col-md-6">
        <table class="table table-striped table-bordered">
            <tr>
                <th>Sample Id</th>
                <th>POXC Value</th>
            </tr>
            @foreach($project->samples as $sample)
            <tr>
                <td>{{ $sample->id }}</td>
                <td>{{ $sample->poxc_result }}</td>
            </tr>
            @endforeach
        </table>

    </div>
</div>