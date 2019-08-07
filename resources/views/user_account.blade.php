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
						<br>
					</div>
					
				</div>
			</div>

	    	<!-- Tab links -->
			<div class="tab mt-5">
			  <button class="tablinks" onclick="openPage(event, 'Profile')" id="defaultOpen"><font size="2">{{ t("Profile") }}</font></button>
			  <button class="tablinks" onclick="openPage(event, 'Projects')"><font size="2">{{ t("Projects") }}</font></button>
			  <button class="tablinks" onclick="openPage(event, 'Settings')"><font size="2">{{ t("Settings") }}</font></button>
			</div>

			<div id="Profile" class="tabcontent">
				<div class="card">
					<div class="card-header">

						<h5><b>PERSONAL DETAILS</b></h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-4">
								<div class="img_group_default">
									<img src="{{url($user->avatar)}}" id="avatar">
								</div>								
							</div>
							<div class="col-sm-6">
								<p><b>Name:</b> {{$user->name}}</p>
								<p><b>Username:</b> {{$user->username}}</p>
								<p><b>Email:</b> {{$user->email}}</p>
								<p><b>Privacy:</b> {{$user->privacy}}</p>
								<p><b>Created at:</b> {{$user->created_at}}</p>
							</div>
						</div>
					</div>
				</div>
				
			</div>

			<div id="Projects" class="tabcontent">
				@foreach($projects as $project)   		     
	          		<div class="img_group mb-3">
	          			<div class="row mb-3">
	          				<div class="col-sm-2">
	          					<a href="projects/{{$project->slug}}">
			            		<img src="{{$project->image}}" alt="Person" width="96" height="96"></a>
		            		</div>
		            		<div class="col-sm-8">
			            		<a href="projects/{{$project->slug}}">
			          				<h6>{{$project->name}}</h6></a>
			          				{{$project->created_at}}
			          				<br>		
			          				{{$project->description}}
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
						<h5><b>UPDATE PERSONAL DETAILS</b></h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-6">
								<form method="post" action="{{ url('en/register/store')}}">
						            {{csrf_field()}}
						            <div class="form-group">
							            <label><b>{{ t("Username (required)") }}</b></label>
							            <input class="form-control"  type="text" name="username" value="{{$user->username}}">
						            </div>
						             <div class="form-group">
							            <label ><b>{{ t("Email Address (required)") }}</b></label>
										<input class="form-control"  type="email" name="email" value="{{$user->email}}">
						            </div>
						            <div class="form-group">
							            <label><b>{{ t("Choose a Password (required)") }}</b></label>
							            <input class="form-control" type="password" name="password">
						            </div>
						            <div class="form-group">
										<label><b>{{ t("Confirm Password (required)") }}</b></label>
										<input class="form-control" type="password" name="password_confirm">
									</div>

						            <button type="submit" class="btn btn-dark btn-block">{{ t("Update Profile") }}</button>
						        <!-- </form> -->
					        </div>
					        <div class="col-sm-6">
					        	<div class="form-group">
						            <label><b>{{ t("Name (required)") }}</b></label>
						            <input class="form-control"  type="text" name="name">       
						        </div>
					          
						        <br>
						        <label><b>{{ t("Who can see this field?") }}</b></label>
								<div class="choice">
									<input id="choice_1" type="radio" name="privacy" value="everyone" checked/>
									<label for="choice_1">{{ t("Everyone") }}</label>
								</div>

						        <div class="choice">
						            <input id="choice_2" type="radio" name="privacy" value="only_me" />
						            <label for="choice_2">{{ t("Only Me") }}</label>
						        </div>

						        <div class="choice">    
						            <input id="choice_3" type="radio" name="privacy" value="all_members" />
						            <label for="choice_3">{{ t("All Members") }}</label>
								</div>
					       
					        	
					        </div>
					        </form>
						</div>

						
					</div>
					
				</div>
						
			</div>
		   

			
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

</script>
@endsection
