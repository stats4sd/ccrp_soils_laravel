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
        </div>
        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
			<div class="row">
	  			<div class="container">
			        <form method="post" action="{{ url('project/store')}}" id="group_details">
			        	 @csrf
			           	<div class="form-group">
							<div class="alert alert-danger alert-block" id="validate_danger"></div>
							<div class="alert alert-success alert-block" id="validate_success"></div>
			             	<label for="exampleInputEmail1"><b>{{ t("Group Name (required)") }}</b></label>
			             	<input class="form-control"  type="text" name="name" value="{{$project->name}}">
			           	</div>
			           	<div class="form-group">
			             	<label for="exampleInputEmail1"><b>{{ t("Group Description (required)") }}</b></label>
			             	<textarea class="form-control"  rows="4" cols="50" name="description" form="group_details">{{$project->description}}</textarea>
			           	</div>


		           		<div class="row">
		           			<div class="col-sm-6">
		           				<b>{{ t("Privacy Options") }}</b>
					           	<div class="form-group">
					           		<input type="radio" name="status" value="Public" checked>
										<label for="public_group" style="color: grey"> {{ t("This is a public group") }}</label>
									<br>
									<input type="radio" name="status" value="Private">
										<label for="private_group" style="color: grey"> {{ t("This is a private group") }}</label>
									<br>
									<input type="radio" name="status" value="Hidden">
										<label for="private_group" style="color: grey"> {{ t("This is a hidden group") }}</label>
									<br>
								</div>
				   			</div>
				   			<div class="col-sm-6">
				   				<b>{{ t("Group Invitations") }}</b>
				   				<div class="form-group">
			   						<div>
				   						<input type="radio" name="group_invitations" value="all_members" checked>
										<label for="group_invitations" style="color: grey">{{ t("All group members") }}</label>
									</div>
									<div>
										<input type="radio" name="group_invitations" value="group_admins">
										<label for="group_invitations" style="color: grey">{{ t("Group admins only") }}</label>
									</div>
				   				</div>
				   			</div>
			           	</div>


			           	<div class="row">
							<div class="col-sm-4">
								<div class="container">
					  				<div class="img_group_default mt-3">
					  					<b>{{ t("Photo") }}</b>

									  	<img id='image' src={{$project->image}}>

									</div>
								</div>
							</div>
							<div class="col-sm-8 mt-5">

								<div class="form-group">
									<br>
									<div class="alert alert-danger alert-block" id="error_photo"></div>
									<div class="alert alert-success alert-block" id="success"></div>
									<br>
									<label> {{ t("Select Photo for Upload") }}</label>
									<br>
									<input type="file" id="file" name="select_file">
									<input type="submit" id="Upload" name="upload" class="btn btn-dark btn-sm" value="Upload">
								</div>
							</div>
				           <button type="submit" id="group_name_descrip" class="btn btn-dark btn-sm mt-5" name="create_group">{{ t("UPDATE GROUP") }}</button>
			       		</div>

					</form>
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
		            		<img src="{{$member->avatar}}" alt="Person"></a>
	            		</div>
		            	</td>
		            	<td>
		            		<div class="form-group">

			            		<div id="change_id{{$member->id}}" value="{{$member->id}}">
		            				<a href="members/{{$member->username}}"><p>{{$member->username}}</p></a>
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
			<div class="row mt-3">
			    <form action="{{$project->id}}/destroy" method="post">

					@csrf
					<div class="col-sm-8">
				  		<b>{{ t("Delete Project") }}</b>
				  		<p>{{ t("You are about to delete this project.") }}</p>
				  		<ul style="list-style-type: circle;">
						  <li>{{ t("You will no longer be able to access the data of this project") }}</li>
						  <li>{{ t("You will no longer be able to access the forms for this project") }}</li>
						</ul>
					</div>


					<div class="col-sm mt-5">
			   			<button  id='delete_project' class="btn btn-dark btn-sm mt-5" name="update_members">{{ t("DELETE PROJECT") }}</button>
			   		</div>
		   	     </form>
       	   </div>
		</div>
    </div>
@endsection
