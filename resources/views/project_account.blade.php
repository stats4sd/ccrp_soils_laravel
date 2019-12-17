@extends('layouts.layout')

@section('content')

	<div class="col-sm-12">
	 	<section class="content mb-5" id="group">
		    <h1 class="mb-5"><b>{{$project->name}}</b></h1>
	    	<div class="container-fluid">
	    		<div class="row">
	    			<div class="col-sm-3">
				    	<div class="img_group_default">
							<img src={{url($project->image)}} id="img_group" >
						</div>
					</div>
					<div class="col-sm-5">
						<br>
						<div id="description">
							<p>{{$project->status}} {{ t("Group") }} {{$project->created_at->diffForHumans()}}</p>
						    <p>{{$project->description}}</p>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="admin_group">
						<h3><b>{{ t("Group Admins") }}</b></h3>
						@if($is_member)
							@foreach ($project->users as $member)
								@if($member->pivot->is_admin)
									<a href={{url(app()->getLocale().'/users/'.$member->slug)}} data-toggle="tooltip" title="{{$member->username}}">
									<img src={{url($member->avatar)}} id="avatar" >
									</a>
								@endif
					    	@endforeach
					    @endif
						</div>
					</div>
				</div>
			</div>

	    	<!-- Tab links -->

			<div class="tab mt-5">
			  <button class="tablinks" onclick="openPage(event, 'Form_data')" id="defaultOpen"><font size="2">{{ t("Form and Data") }}</font></button>
			  <button class="tablinks" onclick="openPage(event, 'Members')" id="buttonMembers"><font size="2">{{ t("Members") }}</font></button>
			  <button class="tablinks" onclick="openPage(event, 'Manage')" id="manageOpen"><font size="2">{{ t("Manage") }}</font></button>
			</div>

			@if($is_member)
				<div id="Form_data" class="tabcontent">
					<div class="row">
			  			<div class="container">
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
												    	<button class="btn btn-dark btn-sm" id="deploy-form-button{{$xls_form->id}}" onclick="deploy({{$project->id}},{{$xls_form->id}})">{{ t("DEPLOY") }}</button>	
												 
												 	 </div>
												</div>
				  							</td>
				  						</tr>
				  						@endforeach
			  					
			  					</tbody>
			  				</table>
							<button class="btn btn-dark btn-sm" id="get-data-button" onclick="getData({{$project->id}})">{{ t("GET DATA") }}</button>
							<a class="btn btn-dark btn-sm text-light" href="{{ url(app()->getLocale(). '/projects/' . $project->id . '/downloaddata') }}" >{{ t("DOWNLOAD DATA") }}</a>
							<a class="btn btn-dark btn-sm text-light" href="{{ url(APP()->getLocale().'/projects/' . $project->id . '/download-samples-merged') }}" >{{ t("SAMPLE MERGED") }}</a>
			 			</div>
			   		</div>
				</div>

				<div id="Members" class="tabcontent">

				 	@if($invitations)
				 	<button class="btn btn-dark btn-sm mt-3 mb-3" id="buttonInvite"><font size="2">{{ t("INVITE") }}</font></button>
					    <button class="btn btn-dark btn-sm mt-3 mb-3" id="buttonShare" onclick="share({{$xls_form->id}},{{$project->id}})"><font size="2">{{ t("SHARE") }}</font></button>
					@endif

					<div id="Invite" class="tabcontent">

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
					</div>



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

				<div id="Manage" class="tabcontent">

					 	@if($is_admin)
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
												<div class="alert alert-danger alert-block" id="error"></div>
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

					   	@else
					   		<div class="alert alert-danger alert-block" id="is_not_admin">
					   			<p><b>{{ t("Access is not allowed.") }}</b> {{ ("Only the admins of this project have the permission for this page.") }}</p>
					   		</div>
					   	@endif
				</div>
			@else
				<div class="alert alert-info alert-block" id="is_not_admin">
					<p><b>{{ t("This is a private group.") }}</b> {{ t("To join you must be a registered site member and request group membership.") }}</p>
				</div>
			@endif
	    </section>
	</div>

@endsection

@section('script')

@include('kobosync')

<script type="text/javascript">


// Changes status member from button CHANGE STATUS
function changeStatus(projectId, userId)
{
	event.preventDefault();
	jQuery.ajax('{{ url(app()->getLocale().'/projects/changeStatus') }}', {
            method: "POST",
            data: {
                projectId: projectId,
                userId: userId,
            }
        }).done(function(res) {
        	jQuery("#member_status".concat(userId)).hide();
        	jQuery('#status'.concat(userId)).show();
        	jQuery('#status'.concat(userId)).html(res.status);
            console.log(res);
        });
}

//Deletes member from project

function deleteMember(projectId, userId)
{
	event.preventDefault();
	if(confirm('Are you sure to delete this user?'))
	{
	jQuery.ajax('{{ url(app()->getLocale().'/projects/deleteMember') }}', {
            method: "POST",
            data: {
                projectId: projectId,
                userId: userId,
            }
        }).done(function(res) {
        	jQuery('#message').html(res.message);
        	location.reload();

        });
    }
}

//Show the members and hide the invite panel
jQuery(document).ready(function(){
	jQuery("#buttonMembers").click(function(event){
		jQuery("#Invite").hide();
		jQuery("#members").show();
	});
});

//button invite
jQuery(document).ready(function(){
	jQuery("#Invite").hide();
	jQuery("#buttonInvite").click(function(event){
		jQuery("#Invite").show();
		jQuery("#members").hide();
	});
});
//check file image validation

jQuery(document).ready(function(){
	jQuery("#success").hide();
	jQuery("#error").hide();

	jQuery("#Upload").click(function(event){
		event.preventDefault();
		var form = document.getElementById('group_details');
		var form_data = new FormData(form);

        $.ajax({
	        url : '{{$project->id}}/uploadImage',
	        type : 'POST',
	        data : form_data,
	        processData: false,
	        contentType: false,
	        success : function(result){
	        	var type = result.type;
	        	var message = result.message;
	        	if(type=='empty'){
	        		jQuery("#success").hide();
	        		jQuery('#error').show();
	        		jQuery("#error").html(message);
	    			//console.log(message);
	    		} else if (type=='error'){
	    			jQuery("#success").hide();
	    			jQuery('#error').show();
	    			jQuery("#error").html(message);
	    			//console.log(message);
	    		} else if (type=='success'){
	    			jQuery("#error").hide();
	    			jQuery('#success').show();
	    			jQuery("#success").html(message);
	   				var url = window.location.origin+'/'+result.image_path;
	    			jQuery("#image").attr('src', url);
	    			jQuery("#img_group").attr('src', url);

	    		}
			}
		});
	});
});

//validation group name and group description
jQuery(document).ready(function(){
	jQuery('#validate_danger').hide();
	jQuery('#validate_success').hide();
	jQuery("#group_name_descrip").click(function(event){
		event.preventDefault();
		var form = document.getElementById('group_details');
		var form_data = new FormData(form);
		console.log(form_data);

		$.ajax({
	        url : '{{$project->id}}/validateGroup',
	        type : 'POST',
	        data : form_data,
	        processData: false,
	        contentType: false,
	        success : function(result){
	        	console.log(result);
	        	var type = result.type;
	        	var message = result.message;
	        	console.log(result);
	        	if(type == 'error'){
	        		jQuery('#validate_danger').show();
	        		jQuery('#validate_success').hide();
	        		jQuery("#validate_danger").html(message);
				} else {
					jQuery('#validate_success').show();
					jQuery('#validate_danger').hide();
	        		jQuery("#validate_success").html(message);
	        		location.reload();
				}
	        }
	    });
	});
});



//Soft delete project
jQuery(document).ready(function(){
	jQuery("#delete_project").click(function(event){
		event.preventDefault();

		if (confirm('Are you sure to delete the project {{$project->name}}?')) {
		    $.ajax({
	        url : '{{$project->id}}/destroy',
	        type : 'POST',
	        processData: false,
	        contentType: false,
	        success : function(result){
	        	console.log(result);
	        	window.location.replace('/');
		        }
		    });
		}
	});
});
</script>
@endsection
