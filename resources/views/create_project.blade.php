
@extends('layouts.layout')

@section('content')

<body>
<div class="col-sm-8">
  <section class="content mb-5" id="group">
    <h1 class="mb-5"><b>{{ t("Project") }}</b></h1>
	<!-- Tab links -->
	<div class="tab">
	  <button class="tablinks" onclick="openPage(event, 'Details')" id="defaultOpen"><font size="2">{{ t("1.Details") }}</font></button>
	  <button class="tablinks" onclick="openPage(event, 'Settings')"><font size="2">{{ t("2. Settings") }}</font></button>
	  <button class="tablinks" onclick="openPage(event, 'Photo')"><font size="2">{{ t("3. Photo") }}</font></button>
	  <button class="tablinks" onclick="openPage(event, 'Invites')"><font size="2">{{ t("4. Send Invites") }}</font></button>
	</div>

	<div id="Details" class="tabcontent">
		<div class="row">
  			<div class="container">

		        <form method="post" action="{{ url('create-project/store')}}" id="group_details">
		        	 @csrf
		           	<div class="form-group">
						<div class="alert alert-danger alert-block" id="validate_details"></div>
		             	<label for="exampleInputEmail1"><b>{{ t("Group Name (required)") }}</b></label>
		             	<input class="form-control"  type="text" name="name">
		           	</div>
		           	<div class="form-group">
		             	<label for="exampleInputEmail1"><b>{{ t("Group Description (required)") }}</b></label>
		             	<textarea class="form-control"  rows="4" cols="50" name="description" form="group_details"></textarea>
		           	</div>
		   
		           <button type="submit" id="group_name_descrip" class="btn btn-dark btn-sm" name="create_group">{{ t("CREATE A GROUP AND CONTINUE") }}</button>
 			</div>
   		</div>
	</div>

	<div id="Settings" class="tabcontent">
		<h3><b>Privacy Options</b></h3>
		<div class="form-group" >
		<div>
			<input type="radio" name="status" value="public" checked> 
			<label for="public_group" style="color: grey"> This is a public group</label>
			<ul>
				<li>Any site member can join this group.</li>
				<li>This group will be listed in the groups directory and in search results.</li>
				<li>Group content and activity will be visible to any site member.</li>
			</ul>
		</div>

		<div>
			<input type="radio" name="status" value="private"> 
			<label for="private_group" style="color: grey"> This is a private group</label>
			<ul>
				<li>Only users who request membership and are accepted can join the group.</li>
				<li>This group will be listed in the groups directory and in search results.</li>
				<li>Group content and activity will only be visible to members of the group.</li>
			</ul>
		</div>

		<div>
			<input type="radio" name="status" value="hidden"> 
			<label for="private_group" style="color: grey"> This is a hidden group</label>
			<ul>
				<li>Only users who are invited can join the group.</li>
				<li>This group will not be listed in the groups directory or search results.</li>
				<li>Group content and activity will only be visible to members of the group.</li>
			</ul>
		</div>
		</div>

		<h3><b>Group Invitations</b></h3>
		<p>Which members of this group are allowed to invite others?</p>
		<div class="form-group">
		<div>
			<input type="radio" name="group_invitations" value="all_members" checked> 
			<label for="group_invitations" style="color: grey"> All group members</label>
		</div>
		<!-- <div>
			<input type="radio" name="group_invitations" value="group_admins_and_mods"> 
			<label for="group_invitations" style="color: grey"> Group admins and mods only</label>
		</div> -->
		<div>
			<input type="radio" name="group_invitations" value="group_admins"> 
			<label for="group_invitations" style="color: grey"> Group admins only</label>
		</div>
		</div>

		<a href="#" onclick="openPage(event, 'Details')" class="btn btn-dark btn-sm" aria-pressed="true">{{ t("BACK TO PREVIOUS STEP") }}</a>
		<a href="#" onclick="openPage(event, 'Photo')" class="btn btn-dark btn-sm" aria-pressed="true">{{ t("NEXT STEP") }}</a>
		
		</form>
	</div>

	<div id="Photo" class="tabcontent">
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="container">
		  				<div class="img_group_default mt-3">
	  					
						  	<img id='image' src={{url("images/mystery-group.png")}}>
						  
						</div>
					</div>
				</div>
				<div class="col-sm-8 mt-3">
					<h4 align="center"><b>Upload Photo</b></h4>
					<br>
					<p>Upload an image to use as a profile photo for this group. The image will be shown on the main group page, and in search results.</p>
				  <p>To skip the group profile photo upload process, hit the "Next Step" button.</p>
				</div>
			</div>
		</div>

	  	<div class="container">
	  		
	  		<br/>
	  	
	  		<div class="alert alert-danger alert-block" id="error"></div>
	  	
	  		<div class="alert alert-success alert-block" id="success"></div>

		  	<form method="post" action="{{ url('create-project/upload')}}" name="Upload" id="upload_image">
		  		{{ csrf_field() }}
		  		<div class="form-group">
				
					<label> {{ t("Select Photo for Upload") }}</label>
					<br>
					<input type="file" id="file" name="select_file">
					<input type="submit" id="Upload" name="upload" class="btn btn-dark btn-sm" value="Upload">
				</div>
			</form>
		
	  	</div>

	  		<a href="#" onclick="openPage(event, 'Settings')" class="btn btn-dark btn-sm" aria-pressed="true">{{ t("BACK TO PREVIOUS STEP") }}</a>
	  		<button type="submit" onclick="openPage(event, 'Invites')" id="store_details" class="btn btn-dark btn-sm">{{ t("NEXT STEP") }}</button>


	</div>
	
	<div id="Invites" class="tabcontent">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<label>Search for members to invite:</label>
					<form  method="post" action="{{url('create-project/sendEmail')}}" name="invite" id="invite">
				  	<input type="text" id="myInput" onkeyup="search()" class="form-control" placeholder="Search for names..">
				  	<div class="scroll_list">
				  		<div class="form-group">
						<table id="myTable" class="table table-hover">
							<tbody>
								@foreach($users as $user)
								<tr>
									<td><input type="checkbox" name="name_selected[]" id="{{$user->name}}" value="{{$user->name}}"> {{$user->name}}</td>		
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					</div>

						<div class="form-group">
							<label for="email">Insert email to invite not members</label>
			    			<input style="width: 100%;" type="email" class="form-control" id="email">
			    		</div>
			    		<a href="#" onclick="openPage(event, 'Photo')" class="btn btn-dark btn-sm" aria-pressed="true">{{ t("BACK TO PREVIOUS STEP") }}</a>
			    		<button type="submit" class="btn btn-dark btn-sm" id="send_email">FINISH</button>	
					</form>

				</div>
				<div class="col-sm-6">
					<div class="alert alert-info">
						<strong> Select people to invite from your friends list.</strong>
					</div>	
					<!-- @foreach($users as $user)
					<br>

					<div class="container" id="myDIV">
						<div class="img_group">
						<img src={{url("images/mystery-group.png")}} id="avatar" >
						{{$user->name}}
						</div>
					<a href="">Remove invite</a>
					</div>
				@endforeach	 -->
				</div>	
			</div>
		</div>
	</div>
</section>
 


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

function search() {
  // Declare variables 
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}



// Display selected person

// document.addEventListener("change", function (e) {
// 	 var x = document.getElementById("myDIV");
//     if (e.target.type === "checkbox") {
//         console.log(e.target.value);
//         x.style.display = "block";
//   	} else {
// 	    x.style.display = "none";
// 	}
// });

//validation group name and group description
jQuery(document).ready(function(){
	jQuery('#validate_details').hide();
	
	jQuery("#group_name_descrip").click(function(event){
		event.preventDefault();
		var form = document.getElementById('group_details');
		var form_data = new FormData(form);
		console.log(form_data);
		$.ajax({
	        url : 'create-project/validateValue', 
	        type : 'POST',
	        data : form_data,
	        processData: false, 
	        contentType: false,
	        success : function(result){
	        	var type = result.type;
	        	var message = result.message;
	        	console.log(result);
	        	if(type == 'error'){
	        		jQuery('#validate_details').show();
	        		jQuery("#validate_details").html(message);
				} else {
					openPage(event, 'Settings');
				}
	        }
	    });
	});
});

//check file image validation

jQuery(document).ready(function(){
	jQuery("#success").hide();
	jQuery("#error").hide();

	jQuery("#Upload").click(function(event){
		event.preventDefault();
		var form = document.getElementById('upload_image');
		var form_data = new FormData(form);
       
        $.ajax({
	        url : 'create-project/upload', 
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
	    			jQuery("#image").attr('src',url);	    			
	    		}	        	
			}
		});
	});
});

//store details project 

jQuery(document).ready(function(){
	
	jQuery("#store_details").click(function(event){
		event.preventDefault();
		var form = document.getElementById('group_details');
		var form_data = new FormData(form);

		var images = $('#image').attr('src');
		form_data.append('image', images );
		
		
        $.ajax({
	        url : 'create-project/store', 
	        type : 'POST',
	        data : form_data,
	        processData: false, 
	        contentType: false,
	        success : function(result){
	        	
	        	console.log(result)
			}
		});
	});
});
//send email for invitating members
Query(document).ready(function(){
	
	jQuery("#send_email").click(function(event){
		event.preventDefault();
		var form = document.getElementById('invite');
		var form_data = new FormData(form);
       
        $.ajax({
	        url : 'create-project/sendEmail', 
	        type : 'POST',
	        data : form_data,
	        processData: false, 
	        contentType: false,
	        success : function(result){
	        	
	        	console.log(result)
			}
		});
	});
});
</script>


@endsection
