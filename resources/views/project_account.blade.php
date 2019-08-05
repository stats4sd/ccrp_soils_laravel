@extends('layouts.layout')

@section('content')

<body>
	<div class="col-sm-8">
	 	<section class="content mb-5" id="group">

	 		
		    <h1 class="mb-5"><b>{{$projects->name}}</b></h1>
	 

	    	<div class="container-fluid">
	    		<div class="row">
	    			<div class="col-sm-3">
				    	<div class="img_group_default">
							<img src={{url($projects->image)}} id="img_group" >
						</div>
					</div>
					<div class="col-sm-5">
						<br>

						<div id="description">
							<p>{{$projects->status}} Group {{$projects->created_at}}</p>
						    <p>{{$projects->description}}</p>
					    	
						</div>
					</div>
					<div class="col-sm-4">
						<div class="admin_group">
						<h3><b>{{ t("Group Admins") }}</b></h3>
						
							@foreach ($members as $member)
								@if($member->pivot->is_admin)
								<a href="members/{{$member->username}}" data-toggle="tooltip" title="{{$member->username}}">
								<img src={{url($member->avatar)}} id="avatar" >
								</a>
								@endif
					    	@endforeach
						</div>
					</div>
				</div>
			</div>

	    	<!-- Tab links -->
			<div class="tab mt-5">
			  <button class="tablinks" onclick="openPage(event, 'Form_data')" id="defaultOpen"><font size="2">{{ t("Form and Data") }}</font></button>
			  <button class="tablinks" onclick="openPage(event, 'Members')" id="buttonMembers"><font size="2">{{ t("Members") }}</font></button>
			  <button class="tablinks" onclick="openPage(event, 'Manage')"><font size="2">{{ t("Manage") }}</font></button>
			</div>

			<div id="Form_data" class="tabcontent">
				<div class="row">
		  			<div class="container">
		  				<table class="table table-striped">
		  					<thead>
		  						<tr>
		  							<th>Form Name</th>
		  							<th>Kototools Form ID</th>
		  							<th>Number of Collected Records</th>
		  							<th>Status</th>
		  							<th>Action</th>
		  						</tr>
		  					</thead>
		  					<tbody>
		  						@foreach($xls_forms as $xls_form)
		  						<tr>
		  							<td>{{ $xls_form->form_title}}</td>
		  							<td>{{ $xls_form->form_id}}</td>
		  							<td></td>
		  							<td></td>
		  							<td></td>
		  						</tr>
		  						@endforeach
		  					</tbody>
		  					
		  				</table>

				        
		 			</div>
		   		</div>
			</div>

			<div id="Members" class="tabcontent">

			  <button class="btn btn-dark btn-sm mt-3 mb-3" id="buttonInvite"><font size="2">{{ t("INVITE") }}</font></button>

				<div id="Invite" class="tabcontent">

					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-6">
								<label>Search for members to invite:</label>
								<form  method="post" action="{{url('en/projects/1/send')}}" name="invite" id="invite">
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
										<label for="email">Enter the email addresses of people to invite.</label>
						    			<input style="width: 100%;" type="email" class="form-control" name="email_inserted" multiple>
						    		</div>
						    	
						    		<button type="submit" class="btn btn-dark btn-sm" id="send_email">{{ t("SUBMIT")}}</button>	
								</form>

							</div>
							<div class="col-sm-6">
								<div class="alert alert-info">
									<strong> Select people to invite from your friends list.</strong>
								</div>	
							
								<br>
								<!-- <div class="container-fluid">
									<div class="row">
										<div class="img_group">
											<img style="display:none" src={{url("images/mystery-group.png")}} id="avatar" >

												<p id="text" style="display:none">Name</p>
										</div>
									</div>
								</div> -->				
							</div>	
						</div>
					</div>

					</div> 
	            <div id="members">
				@foreach($members as $member)
	   		     
	          		<div class="img_group mb-3">	          				
	          			<div class="row mb-3">
	          				<div class="col-sm-1">
	          					<a href="members/{{$member->username}}">
			            		<img src="{{$member->avatar}}" alt="Person" width="96" height="96"></a>
		            		</div>
		            		<div class="col-sm-8 mt-3">
			            		<a href="members/{{$member->username}}">{{$member->username}}</a>		            		
			          		</div>		
			          		<br>					          		
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
					             	<input class="form-control"  type="text" name="name" value="{{$projects->name}}">
					           	</div>
					           	<div class="form-group">
					             	<label for="exampleInputEmail1"><b>{{ t("Group Description (required)") }}</b></label>
					             	<textarea class="form-control"  rows="4" cols="50" name="description" form="group_details">{{$projects->description}}</textarea>
					           	</div>
					
				           
				           		<div class="row">			           				
				           			<div class="col-sm-6">
			           				<b>Privacy Options</b>
							           	<div class="form-group">
							           		<input type="radio" name="status" value="Public" checked> 
												<label for="public_group" style="color: grey"> This is a public group</label>
											<br>
											<input type="radio" name="status" value="Private"> 
												<label for="private_group" style="color: grey"> This is a private group</label>
											<br>
											<input type="radio" name="status" value="Hidden"> 
												<label for="private_group" style="color: grey"> This is a hidden group</label>
											<br>
										</div>
						   			</div>
						   			<div class="col-sm-6">
						   				<b>Group Invitations</b>
						   				<div class="form-group">
					   						<div>
						   						<input type="radio" name="group_invitations" value="all_members" checked> 
												<label for="group_invitations" style="color: grey"> All group members</label>
											</div>
											<div>
												<input type="radio" name="group_invitations" value="group_admins"> 
												<label for="group_invitations" style="color: grey"> Group admins only</label>
											</div>	
						   				</div>				
						   			</div>
					           	</div>


					           	<div class="row">
									<div class="col-sm-4">
										<div class="container">
							  				<div class="img_group_default mt-3">
							  					<b>Photo</b>
						  					
											  	<img id='image' src={{$projects->image}}>
											  
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


								
										<div class="container">
							  				<div class="img_group mt-3">
							  					<b>Members</b>
						  					<table class="table table-hover">
						  						<thead>
												    <tr>
												      <th scope="col">Avatar</th>
												      <th scope="col">Username</th>
												      <th scope="col">Status</th>
												      <th scope="col">Actions</th>
												    </tr>
												</thead>
												<tbody>

												 
											  @foreach($members as $member)
											   <tr>
									   		  <td>
								          		<div class="img_group mb-3">	          			
						          					<a href="members/{{$member->username}}">
								            		<img src="{{$member->avatar}}" alt="Person"></a>
							            		</div>  
								            	</td>
								            	<td>
							            		<a href="members/{{$member->username}}"><p>{{$member->username}}</p></a>
								            	</td>
								            	<td>
								            		@if($member->pivot->is_admin)
								            		<p>Admin</p>
								            		@else
								            		<p>User</p>
								            		@endif
								            		
								            	</td>
								            	<td>
								            		delete
								            		
								            	</td>

								    		   	</tr>     
								      		@endforeach
								      	
										      	</tbody>
												</table>
											</div>
										
									<div class="col-sm-8 mt-5">
										
										<div class="form-group">


										</div>
													
									</div>
						           <button type="submit" id="update_members" class="btn btn-dark btn-sm mt-5" name="update_members">{{ t("UPDATE MEMBERS") }}</button>
					       		</div>

					        
				 			</div>
			   		</div>
			   	@else
			   		<div class="alert alert-danger alert-block" id="is_not_admin">
			   			<p><b>Access is not allowed.</b> Only the admins of this project have the permission for this page.</p>
			   		</div>
			   	@endif
			   


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

//button members
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
	        url : '/en/projects/{{$projects->id}}/upload', 
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
	        url : '/en/projects/{{$projects->id}}/validateGroup', 
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

</script>
@endsection
