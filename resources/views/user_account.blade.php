@extends('layouts.layout')

@section('content')

<body>
	<div class="col-sm-8">
	 	<section class="content mb-5" id="group">

	 		
		    <h1 class="mb-5"><b>{{$user->name}}</b></h1>
	 

	    	<div class="container-fluid">
	    		<div class="row">
	    			<div class="col-sm-3">
				    	<div class="img_group_default">
							<img src="{{url($user->avatar)}}" id="avatar">
						</div>
					</div>
					<div class="col-sm-5">
						<p><b>Kobotoolbox:</b> {{$user->kobo_id}}</p>
						<p><b>Groups:</b> {{$user->projects->count()}}</p>
						<p><b>Created:</b> {{$user->created_at->diffForHumans()}}</p>
					</div>
					
				</div>
			</div>

	    	<!-- Tab links -->
			<div class="tab mt-5">
			  <button class="tablinks" onclick="openPage(event, 'Profile')" id="defaultOpen"><font size="2">{{ t("Profile") }}</font></button>
			  <button class="tablinks" onclick="openPage(event, 'Projects')"><font size="2">{{ t("Projects") }}</font></button>
			  <button class="tablinks" onclick="openPage(event, 'Settings')"><font size="2">{{ t("Settings") }}</font></button>
			</div>
			@if(Auth::id()==$user->id)

			<div id="Profile" class="tabcontent">
				<div class="card">
					<div class="card-header">

						<h5><b>PERSONAL DETAILS</b></h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-4">
								<div class="img_group_default">
									<img src="{{url($user->avatar)}}" id="avatar_card">
								</div>								
							</div>
							<div class="col-sm-6">
								<p><b>Name:</b> {{$user->name}}</p>
								<p><b>Username:</b> {{$user->username}}</p>
								<p><b>Email:</b> {{$user->email}}</p>
								<p><b>Privacy:</b> {{$user->privacy}}</p>
							</div>
						</div>
					</div>
				</div>
				
			</div>

			<div id="Projects" class="tabcontent">
				@foreach($projects as $project)   		     
	          		<div class="card mb-3" style="max-width: 540px;">
	          			<div class="row no-gutters">
						    <div class="col-md-4 img_card_project mb-3 mt-3">
						      <a href="projects/{{$project->slug}}"><img src={{$project->image}} class="center" alt="Project"></a>
						    </div>
						    <div class="col-md-8">
								<div class="card-body">
									<a href="projects/{{$project->slug}}"><h5 class="card-title"><b>{{$project->name}}</b></h5></a>
									<p class="card-text">{{$project->description}}</p>
									<p class="card-text"><small class="text-muted">{{$project->created_at->diffForHumans()}}</small></p>
								</div>
						    </div>
						</div>	
	          		</div>
      			@endforeach
			</div>
			
			<div id="Settings" class="tabcontent">
				<div class="card">
					<div class="card-header">
						<h5><b>UPLOAD PICTURE PROFILE</b></h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-4">
								<div class="img_group_default mt-3">
								  	<img id='image' src="{{$user->avatar}}">
								</div>
								
							</div>
							<div class="col-sm-8 mt-5">
								<form method="post" action="{{ url('avatar/upload')}}" name="Upload" id="upload_image">
						  		{{ csrf_field() }}
						  		<div class="form-group">
								
									<label> {{ t("Select Photo for Upload") }}</label>
									<br>
									<input type="file" id="file" name="select_file">
									<input type="submit" id="Upload" name="upload" class="btn btn-dark btn-sm" value="Upload">
								</div>
								</form>
							</div>
						</div>	
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<h5><b>KOBOTOOLBOX ACCOUNT</b></h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-6">
								<form method="post" action="/en/projects/members/{{$user->id}}/kobo-user" id="kobo">
						            {{csrf_field()}}
						         
						            <div class="form-group">
							            <label><b>{{ t("Enter with Kobotoolbox Account") }}</b></label>
							            <input class="form-control" type="text" name="kobo_id">
						            </div>
						           
						            <button type="submit" class="btn btn-dark btn-block" id="kobo-user">{{ t("KOBOTOOLBOX ACCOUNT") }}</button>
						        </form>
					        </div>
					        <div class="col-sm-6">
					        	<label><b>Current Account</b></label>
					        	<p id="current_account">{{$user->kobo_id}}</p>
					        	
					        </div>
				        </div>	
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<h5><b>UPDATE PERSONAL DETAILS</b></h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-6">
								<form method="post" action="/en/projects/members/{{$user->id}}/validateDetails'" id="profile_details">
						            {{csrf_field()}}
						            <div class="form-group">
						            	<div class="alert alert-danger alert-block" id="validate_danger"></div>
										<div class="alert alert-success alert-block" id="validate_success"></div>
							            <label><b>{{ t("Username (required)") }}</b></label>
							            <input class="form-control"  type="text" name="username" value="{{$user->username}}">
						            </div>
						             <div class="form-group">
							            <label ><b>{{ t("Email Address (required)") }}</b></label>
										<input class="form-control"  type="email" name="email" value="{{$user->email}}">
										 @if($errors->has('email'))
						                <span class="" role="alert">
						                    <strong style="color: #a22a2a;">{{ $errors->first('email') }}</strong>
						                </span>
						              @endif
						            </div>
						           

						            <button type="submit" class="btn btn-dark btn-block" id="prof_details">{{ t("Update Profile") }}</button>
						  
					        </div>
					        <div class="col-sm-6">
					        	<div class="form-group">
						            <label><b>{{ t("Name (required)") }}</b></label>
						            <input class="form-control"  type="text" name="name" value="{{$user->name}}">       
						        </div>
					          
						        <br>
						        <label><b>{{ t("Who can see this field?") }}</b></label>
								<div class="choice">
									<input id="choice_1" type="radio" name="privacy" value="Everyone" checked/>
									<label for="choice_1">{{ t("Everyone") }}</label>
								</div>

						        <div class="choice">
						            <input id="choice_2" type="radio" name="privacy" value="Only Me" />
						            <label for="choice_2">{{ t("Only Me") }}</label>
						        </div>

						        <div class="choice">    
						            <input id="choice_3" type="radio" name="privacy" value="All Members" />
						            <label for="choice_3">{{ t("All Members") }}</label>
								</div>
					       
					        	
					        </div>
					        </form>
						</div>
			
					</div>
					
				</div>
				<div class="card">
					<div class="card-header">
						<h5><b>CHANGE PASSWORD</b></h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-6">
								<form method="post" action="/en/projects/members/{{$user->id}}/changePassword" id="password">
						            {{csrf_field()}}
						            <div class="alert alert-danger alert-block" id="password_danger"></div>
									<div class="alert alert-success alert-block" id="password_success"></div>
						            <div class="form-group">
							            <label><b>{{ t("Enter a Old Password (required)") }}</b></label>
							            <input class="form-control" type="password" name="password">
						            </div>
						            <div class="form-group">
							            <label><b>{{ t("Choose a Password (required)") }}</b></label>
							            <input class="form-control" type="password" name="new_password">
						            </div>
						            <div class="form-group">
										<label><b>{{ t("Confirm Password (required)") }}</b></label>
										<input class="form-control" type="password" name="new_password_confirm">
									</div>

						            <button type="submit" class="btn btn-dark btn-block" id="change_password">{{ t("CHANGE PASSWORD") }}</button>
						        </form>
					        </div>
				        </div>	
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<h5><b>DELETE PROFILE</b></h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-12">
								<form method="post" action="/en/projects/members/{{$user->id}}/deleteProfile" id="delete">
						            {{csrf_field()}}
						           
						            	<p>You are about to permanently delete yuor profile</p>
						            	<ul style="list-style-type: circle;">
								            <li>You will no longer be able to access to your project data.</li>
										    <li>You will no longer be able to access to the forms for your projects.</li>
										</ul>
        
					        </div>
					        <div class="col-sm-6">
					        		<button type="submit" class="btn btn-dark btn-block" id="delete_profile">{{ t("DELETE PROFILE") }}</button>
						        </form>					        	
					        </div>
				        </div>	
					</div>
				</div>
			</div>
			@endif
	    </section>
	</div>
	
</body>

@endsection

@section('script')
<script type="text/javascript">	
	function openPage(evt, pageName) {
	var i, tabcontent, tablinks;
	tabcontent = document.getElementsByClassName("tabcontent");
	for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	}
	tablinks = document.getElementsByClassName("tablinks");
	for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" active", "");
	}
	document.getElementById(pageName).style.display = "block";
	evt.currentTarget.className += " active";
}
// Get the element with id="defaultOpen" and click on it
window.onload = function openDefaultPage() {
	document.getElementById("defaultOpen").click();
}

//check file image validation

jQuery(document).ready(function(){
	jQuery("#success").hide();
	jQuery("#error").hide();

	jQuery("#Upload").click(function(event){
		event.preventDefault();
		var form = document.getElementById('upload_image');
		var form_data = new FormData(form);
       
        $.ajax({
	        url : '/en/projects/members/{{$user->id}}/upload', 
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
	    			jQuery("#avatar").attr('src', url); 
	    			jQuery("#avatar_card").attr('src', url); 

	    		}	        	
			}
		});
	});
});

//validation profile details
jQuery(document).ready(function(){
	jQuery('#validate_danger').hide();
	jQuery('#validate_success').hide();	
	jQuery("#prof_details").click(function(event){
		event.preventDefault();
		var form = document.getElementById('profile_details');
		var form_data = new FormData(form);
		console.log(form_data);

		$.ajax({
	        url : '/en/projects/members/{{$user->id}}/validateDetails', 
	        type : 'POST',
	        data : form_data,
	        processData: false, 
	        contentType: false,
	        success : function(result){
	        	
	        	var type = result.type;
	        	var message = result.message;
	        	console.log(result);

	        	if(type == 'error'){
	        		jQuery('#validate_danger').show();
	        		jQuery('#validate_success').hide();
	        		jQuery("#validate_danger").html(result);
				} else {
					jQuery('#validate_success').show();
					jQuery('#validate_danger').hide();	
	        		jQuery("#validate_success").html(result);
	        		location.reload();

				}
	        }

	    });
	});
});

//validation password
jQuery(document).ready(function(){
	jQuery('#password_danger').hide();
	jQuery('#password_success').hide();

	jQuery("#change_password").click(function(event){
		event.preventDefault();
		var form = document.getElementById('password');
		var form_data = new FormData(form);
		console.log(form_data);

		$.ajax({
	        url : '/en/projects/members/{{$user->id}}/changePassword', 
	        type : 'POST',
	        data : form_data,
	        processData: false, 
	        contentType: false,
	        success : function(result){
	        	
	        	var type = result.type;
	        	var message = result.message;
	        	console.log(result);

	        	if(type == 'error'){
	        		jQuery('#password_danger').show();
	        		jQuery('#password_success').hide();
	        		jQuery("#password_danger").html(message);
				} else {
					jQuery('#password_success').show();
					jQuery('#password_danger').hide();	
	        		
	        		location.reload();

				}
	        }

	    });
	});
});

//Delete user
jQuery(document).ready(function(){
	jQuery("#delete_profile").click(function(event){
		event.preventDefault();
		
		if (confirm('Are you sure to delete the your profile {{$user->username}}?')) {
		    
		    $.ajax({
	        url : '/en/projects/members/{{$user->id}}/deleteProfile', 
	        type : 'POST',
	        processData: false, 
	        contentType: false,
	        success : function(result){
	        	console.log(result);
		        	if(result.type=="success")
		        	{
		        		window.location.replace("/en/home");
		        	}      	        	        	
		        }
		    });
		
		} 		
	});
});

//Kobotoolbox account
jQuery(document).ready(function(){
	jQuery("#kobo-user").click(function(event){
		event.preventDefault();
		var form = document.getElementById('kobo');
		var form_data = new FormData(form);
		console.log(form_data);

		$.ajax({
	        url : '/en/projects/members/{{$user->id}}/kobo-user', 
	        type : 'POST',
	        data : form_data,
	        processData: false, 
	        contentType: false,
	        success : function(result){
	        	
	        	var type = result.type;
	        	var message = result.message;
	        	jQuery("#current_account").html(message);

	        }

	    });
	});
});
</script>
@endsection
