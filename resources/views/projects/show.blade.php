@extends('layouts.full_width')

@section('content')

    <h1 class="mb-5"><b>{{$project->name}}</b></h1>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3">
		    	<div class="img_group_default">
					<img src="{{ url($project->avatar) }}" id="img_group" >
				</div>
			</div>
			<div class="col-sm-5">
				<br>
				<div id="description">
				    <p>{{ $project->description }}</p>
				</div>
			</div>
            <div class="col-sm-4 border border-right-0 border-bottom-0 border-top-0">
				<div class="admin_group">
					<h3 class="pb-2"><b>{{ t("Admins") }}</b></h3>
                    	@foreach ($project->admins as $admin)
							<a
                                href="{{ route('users.show', $admin->slug )}}"data-toggle="tooltip"
                                title="{{ $admin->username }}"
                                class="d-flex flex-row justify-content-start align-items-center">
							<img src="{{ url($admin->avatar) }}" id="avatar" >
                            <h5 class="pl-3">{{ $admin->name }}</h5>
							</a>
				    	@endforeach
				</div>
			</div>
		</div>
	</div>

	<!-- Tab links -->

	<nav class="mt-5">
        <ul class="nav nav-tabs mr-auto" id="project-tabs" role="tablist">
            <li class="nav-item">
                <a
                    href="#forms"
                    class="nav-link active"
                    id="forms-tab"
                    data-toggle="tab"
                    role="tab"
                    aria-controls="forms"
                    aria-selected="true"
                    >Data Collection Forms</a>
            </li>
            <li class="nav-item">
                <a
                    href="#data"
                    class="nav-link"
                    id="data-tab"
                    data-toggle="tab"
                    role="tab"
                    aria-controls="data"
                    aria-selected="true"
                    >Project Data</a>
            </li>
            <li class="nav-item">
                <a
                    href="#members"
                    class="nav-link"
                    id="members-tab"
                    data-toggle="tab"
                    role="tab"
                    aria-controls="members"
                    aria-selected="true"
                    >Project Members</a>
            </li>
            <li class="nav-item">
                <a
                    href="#settings"
                    class="nav-link"
                    id="settings-tab"
                    data-toggle="tab"
                    role="tab"
                    aria-controls="settings"
                    aria-selected="true"
                    >Project Settings</a>
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

@section('scripts')

<script type='text/javascript'>
    function preview_image(event)
    {
        var reader = new FileReader();
        reader.onload = function()
        {
            var output = document.getElementById('avatar');
            var outputLabel = document.getElementById('avatar-caption');
            output.src = reader.result;
            outputLabel.innerHTML = "Preview of image to upload";
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection