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

<div class="tab-content" id="project-tab-content">
    <div class="tab-pane fade show active" id="forms" role="tabpanel" aria-labelledby="forms-tab">
        @include('projects.tab-forms')
    </div>
    <div class="tab-pane fade" id="data" role="tabpanel" aria-labelledby="data-tab">
        @include('projects.tab-data')
    </div>
    <div class="tab-pane fade" id="members" role="tabpanel" aria-labelledby="members-tab">
        @include('projects.tab-members')
    </div>
    <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
        @include('projects.tab-settings');
    </div>
</div>
@endsection

@push('scripts')

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