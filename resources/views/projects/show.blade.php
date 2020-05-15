@extends('layouts.two_panel')

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
            <div class="container mt-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>{{ t("Form Name") }}</th>
                            <th>{{ t("Kobotools Form ID") }}</th>
                            <th>{{ t("Records") }}</th>
                            <th>{{ t("Status") }}</th>
                            <th>{{ t("Action") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach( $project->xls_forms as $xls_form)
                            <tr>
                                <td>{{ $xls_form->form_title }}</td>
                                <td>{{ $xls_form->pivot->form_kobo_id_string }}</td>
                                <td>{{ $xls_form->pivot->records }}</td>
                                <td>
                                    @if($xls_form->pivot->deployed)
                                        <p>{{ t("deployed") }}</p>
                                    @else
                                        <p>{{ t("undeployed") }}</p>
                                    @endif
                                </td>
                                <td>
                                    <div class="w3-show-inline-block">
                                        <div class="w3-bar">
                                            <a
                                                href="{{ route('kobo.publish', [
                                                    'locale' => app()->getLocale(),
                                                    'project' => $project->slug,
                                                    'form' => $xls_form->id ]
                                                    )}}"
                                                class="btn btn-dark btn-sm"
                                                id="deploy-form-button{{$xls_form->id}}"
                                                onclick="deploy(event)">
                                                {{ t("DEPLOY") }}
                                            </a>

                                         </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                    </tbody>
                </table>

                <a class="btn btn-dark btn-sm text-light" href="{{ url(APP()->getLocale().'/projects/' . $project->slug . '/download-samples-merged') }}"  onclick="getDownload(event)" data-toggle="popover">{{ t("DOWNLOAD DATA") }}</a>
                <div hidden class="alert alert-danger alert-block" id="error"></div>
            </div>

        </div>
        <div class="tab-pane fade" id="data" role="tabpanel" aria-labelledby="data-tab">

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

        </div>
        <div class="tab-pane fade" id="members" role="tabpanel" aria-labelledby="members-tab">

            {{-- <div id="Invite" class="tabcontent">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <label>{{ t("Search for members to invite:") }}</label>
                            <form  method="post" action="{{url('en/projects/'.$project->id.'/send')}}" name="invite" id="invite">
                            {{ csrf_field() }}
                            <input type="text" id="myInput" onkeyup="search()" class="form-control" placeholder="Search for names..">
                            <div class="scroll_list">
                                <div class="form-group">
                                <table id="myTable" class="table table-hover">
                                    <tbody>
                                        @foreach($users as $user)

                                            <tr>
                                                <td><input class="checkboxClass" type="checkbox" name="name_selected[]" id="{{$user->id}}" value="{{$user->id}}"> {{$user->name}}</td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </div>

                                <div class="form-group">
                                    <label for="email">{{ t("Enter the email addresses of people to invite.") }}</label>
                                    <input style="width: 100%;" type="email" class="form-control" name="email_inserted" multiple>
                                </div>

                                <button type="submit" class="btn btn-dark btn-sm" id="send_email">{{ t("SUBMIT")}}</button>
                            </form>

                        </div>
                        <div class="col-sm-6">
                            <div class="alert alert-info">
                                <strong>{{ t("Select people to invite from your friends list.") }}</strong>
                            </div>

                        </div>
                    </div>
                </div>
            </div> --}}



            <div id="members">
            @foreach($project->users as $member)

                <div class="card mb-3" style="max-width: 350px;">
                    <div class="row no-gutters">
                        <div class="col-md-4 img_group mb-3 mt-3">
                          <a href={{url(app()->getLocale().'/users/'.$member->slug)}}><img src="{{$member->avatar}}" class="center" alt="Person"></a>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <a href={{url(app()->getLocale().'/users/'.$member->slug)}}><h5 class="card-title"><b>{{$member->username}}</b></h5></a>
                                <p class="card-text"><small class="text-muted"><b>{{ t("created at :") }}</b> {{$member->created_at->diffForHumans()}}</small></p>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
            </div>

            <div class="container">
                <div class="img_group mt-3">
                    <b>{{ t("Members") }}</b>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">{{ t("Avatar") }}</th>
                                <th scope="col">{{ t("Username") }}</th>
                                <th scope="col">{{ t("Status") }}</th>
                                <th scope="col">{{ t("Actions") }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            <form method="post" action="" id="change_details">

                                @csrf

                                @foreach($project->users as $member)

                                    <tr>
                                        <td>
                                            <div class="img_group mb-3">
                                                <a href="members/{{$member->username}}">
                                                    <img src="{{$member->avatar}}" alt="Person">
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">

                                                <div id="change_id{{$member->id}}" value="{{$member->id}}">
                                                    <a href="members/{{$member->username}}"><p>{{$member->username}}</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div id="member_status{{$member->id}}">
                                                @if($member->pivot->is_admin)
                                                    <p>{{ t("Admin") }}</p>
                                                @else
                                                    <p>{{ t("User") }}</p>
                                                @endif
                                            </div>
                                            <p id="status{{$member->id}}"></p>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-dark btn-sm" name="update_members" onclick="changeStatus({{$project->id}},{{$member->id}})">{{ t("CHANGE STATUS") }}</button>
                                            <button type="submit" id="delete" class="btn btn-dark btn-sm" onclick="deleteMember({{$project->id}},{{$member->id}})" name="update_members">{{ t("DELETE") }}</button>

                                        </td>
                                    </tr>
                                @endforeach
                            </form>

                        </tbody>
                    </table>
                </div>
            </div>
            <button onclick="openPage(event, 'Members')" class="btn btn-dark btn-sm mt-5" name="update_members">{{ t("INVITE MEMBERS") }}</button>

        </div>
        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
            @include('projects.edit');
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