<div class="row">
<div class="col-md-6">
<ul class="list-group">
    <li class="list-group-item d-flex p-0">
        <div class="w-50 m-0 p-3">Test Form on Kobo?</div>
        <div class="w-50 m-0 p-3 {{ $widget['form']->kobo_id ? 'bg-success' : 'bg-secondary' }}">
            <b id="kobo_url">
                @if($widget['form']->kobo_id)
                    <a target="_blank" href="{{ config('services.kobo.endpoint') }}/#/forms/{{ $widget['form']->kobo_id }}/" class="btn btn-link text-white font-weight-bold text-center">Yes - View on Kobo</a>
                @else
                    No
                @endif
            </b>
        </div>
    </li>
    <li class="list-group-item d-flex p-0">
        <div class="w-50 m-0 p-3">Test Active on Kobo?</div>
        <div class="w-50 m-0 p-3 {{ $widget['form']->is_active ? 'bg-success' : 'bg-secondary' }}">
            <b id="enketo_url">
                @if($widget['form']->is_active)
                    <a target="_blank" href="{{ $widget['form']->enketo_url }}/" class="btn btn-link text-white font-weight-bold text-center">Yes - Show Webform</a>
                @else
                    No
                @endif
            </b>
        </div>
    </li>
    <li class="list-group-item d-flex p-0">
        <div class="w-50 m-0 p-3">No. of Submissions:</div>
        <div class="w-50 m-0 p-3 d-flex">
            <b>{{ $widget['form']->submissions->count() }}</b>
            <a href="#" class="btn btn-primary ml-4">Download Submissions</a>
        </div>
    </li>
</ul>
</div>
</div>