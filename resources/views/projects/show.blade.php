@extends('layouts.full_width')

@section('content')

@include('projects.header')

<!-- Tab links -->

<nav class="mt-5">
    <ul class="nav nav-tabs mr-auto" id="project-tabs" role="tablist">
        <li class="nav-item">
            <a href="#forms" class="nav-link active" id="forms-tab" data-toggle="tab" role="tab" aria-controls="forms" aria-selected="true">Data Collection Forms</a>
        </li>
        <li class="nav-item">
            <a href="#data" class="nav-link" id="data-tab" data-toggle="tab" role="tab" aria-controls="data" aria-selected="true">Project Data</a>
        </li>
        <li class="nav-item">
            <a href="#members" class="nav-link" id="members-tab" data-toggle="tab" role="tab" aria-controls="members" aria-selected="true">Project Members</a>
        </li>
        <li class="nav-item">
            <a href="#settings" class="nav-link" id="settings-tab" data-toggle="tab" role="tab" aria-controls="settings" aria-selected="true">Project Settings</a>
        </li>
    </ul>
</nav>

<div id="vue-app">
    <div class="tab-content" id="project-tab-content">
        <div class="tab-pane fade show active" id="forms" role="tabpanel" aria-labelledby="forms-tab">
            @if(!auth()->user()->kobo_id)
                <div class="alert alert-info text-dark">
                    Note - you have not entered your KoboToolbox Username, which means you will not be able to see these formson KoboToolbox or ODK Collect. You can update your <a href="{{ route('users.edit', auth()->user()) }}">account here</a>.<br/><br/>
                    You still have access to all the data collected with these forms.
                </div>
            @endif
                <project-forms-table
                :project="{{ $project->toJson() }}"
                :project-forms="{{ $project->project_xlsforms->toJson() }}"
                :user-id="{{ auth()->user()->id }}"
                >
                </project-forms-table>
        </div>
        <div class="tab-pane fade" id="data" role="tabpanel" aria-labelledby="data-tab">
            <project-data-table
                :project="{{ $project->toJson() }}"
                :user-id="{{ auth()->user()->id }}"
                :samples="{{ $project->samples->toJson() }}"
            ></project-data-table>
            <a href="{{ route('projects.downloadsamples', $project) }}" class="btn btn-info">Download Merged Sample Data</a>
        </div>
        <div class="tab-pane fade" id="members" role="tabpanel" aria-labelledby="members-tab">
            @include('projects.tab-members')
        </div>
        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
            @include('projects.tab-settings');
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/projectforms.js') }}"></script>
<script>
    $(document).ready(() => {

        let url = location.href.replace(/\/$/, "");

        if (location.hash) {
            const hash = url.split("#");
            $('#project-tabs a[href="#' + hash[1] + '"]').tab("show");
            url = location.href.replace(/\/#/, "#");
            history.replaceState(null, null, url);
            setTimeout(() => {
                $(window).scrollTop(0);
            }, 400);
        }

        $('a[data-toggle="tab"]').on("click", function() {
            let newUrl;
            const hash = $(this).attr("href");
            if (hash == "#forms") {
                newUrl = url.split("#")[0];
            } else {
                newUrl = url.split("#")[0] + hash;
            }
            newUrl += "/";
            history.replaceState(null, null, newUrl);
        });
    });
</script>
@endpush