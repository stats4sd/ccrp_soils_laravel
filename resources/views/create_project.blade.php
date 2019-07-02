
@extends('layouts.layout')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/jcrop/dist/jcrop.css">
<body>
<div class="col-sm-8">
  <section class="content mb-5" id="generate_qr_code">
    <h1 class="mb-5"><b>{{ t("Group") }}</b></h1>
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

		        <form method="post" action="login.php" id="group_details">
		           	<div class="form-group">
		             	<label for="exampleInputEmail1"><b>{{ t("Group Name (required)") }}</b></label>
		             	<input class="form-control"  type="text" name="group_name">
		           	</div>
		           	<div class="form-group">
		             	<label for="exampleInputEmail1"><b>{{ t("Group Description (required)") }}</b></label>
		             	<textarea class="form-control"  rows="4" cols="50" name="comment" form="group_details"></textarea>
		           	</div>
		   
		          
		           <button type="submit"  onclick="openPage(event, 'Settings')" class="btn btn-dark btn-sm" name="create_group">{{ t("CREATE A GROUP AND CONTINUE") }}</button>
		        </form>
         
 			</div>
   		</div>
	</div>

	<div id="Settings" class="tabcontent">
		<!-- <form method="post" action="login.php" id="group_details"> -->
		 	<!-- <div class="form-group"> -->
		<h3><b>Privacy Options</b></h3>
		<div>
			<input type="radio" name="type_group" id="public_group" checked> 
			<label for="public_group" style="color: grey"> This is a public group</label>
			<ul>
				<li>Any site member can join this group.</li>
				<li>This group will be listed in the groups directory and in search results.</li>
				<li>Group content and activity will be visible to any site member.</li>
			</ul>
		</div>

		<div>
			<input type="radio" name="type_group" id="private_group"> 
			<label for="private_group" style="color: grey"> This is a private group</label>
			<ul>
				<li>Only users who request membership and are accepted can join the group.</li>
				<li>This group will be listed in the groups directory and in search results.</li>
				<li>Group content and activity will only be visible to members of the group.</li>
			</ul>
		</div>

		<div>
			<input type="radio" name="type_group" id="hidden_group"> 
			<label for="private_group" style="color: grey"> This is a hidden group</label>
			<ul>
				<li>Only users who are invited can join the group.</li>
				<li>This group will not be listed in the groups directory or search results.</li>
				<li>Group content and activity will only be visible to members of the group.</li>
			</ul>
		</div>

		<h3><b>Group Invitations</b></h3>
		<p>Which members of this group are allowed to invite others?</p>
		<div>
			<input type="radio" name="group_invitations" id="group_invitations" checked> 
			<label for="group_invitations" style="color: grey"> All group members</label>
		</div>
		<div>
			<input type="radio" name="group_invitations" id="group_invitations"> 
			<label for="group_invitations" style="color: grey"> Group admins and mods only</label>
		</div>
		<div>
			<input type="radio" name="group_invitations" id="group_invitations"> 
			<label for="group_invitations" style="color: grey"> Group admins only</label>
		</div>

		<a href="#" onclick="openPage(event, 'Details')" class="btn btn-dark btn-sm" aria-pressed="true">{{ t("BACK TO PREVIOUS STEP") }}</a>
		<a href="#" onclick="openPage(event, 'Photo')" class="btn btn-dark btn-sm" aria-pressed="true">{{ t("NEXT STEP") }}</a>
		 <!-- </div> -->
		<!-- </form> -->
	</div>

	<div id="Photo" class="tabcontent">
	  
	  <p>Upload an image to use as a profile photo for this group. The image will be shown on the main group page, and in search results.</p>
	  <p>To skip the group profile photo upload process, hit the "Next Step" button.</p>

	  <div class="container">
	  	<h3 align="center">Upload File</h3>
	  	<br/>
	  	@if(count($errors)>0)
	  	<div class="alert alert-danger">Upload Validation Error<br><br>
	  		<ul>
	  			@foreach( $errors->all() as $error)
	  			<li>{{ $error }}</li>
	  			@endforeach
	  		</ul>
	  	</div>
	  	@endif
	  	@if($message = Session::get('success'))
	  	<div class="alert alert-success alert-block">
	  		<button type="button"  class="close" date-dismiss="alert">x</button>
	  		<strong>{{ $message }}</strong>
	  	</div>
	  	<img src="/images/{{ Session::get('path') }}" id="jcrop_target" width="300"/>
	  	@endif

	  	<form method="post" action="{{ url('en/create-project')}}" enctype="multipart/form-data">
	  		{{ csrf_field() }}
	  		<div class="form-group">
	  			<table class="table">
	  				<tr>
	  					<td width="40%" align="right"><label>Select File for Upload</label></td>
	  					<td width="30"><input type="file" name="select_file"></td>
	  					<td width="30%" align="left"><input type="submit" name="upload" class="btn btn-dark btn-sm" value="Upload"></td>
	  				</tr>
	  				<tr>
	  					
	  					<td width="30"><span class="text-muted">jpeg, jpg, png, gif</span></td>
	  					<td width="30%" align="left"></td>
	  				</tr>
	  				
	  			</table>
	  			
	  		</div>
	  	</form>


	</div>
	</div>

	<div id="Invites" class="tabcontent">
		<div class="container">
		<label>Search for members to invite:</label>
	  <input type="text" id="myInput" onkeyup="search()" placeholder="Search for names..">

		<table id="myTable">
			<ul>
				@foreach($users as $user)
				<li>{{$user->name}}</li>
				@endforeach
			</ul>
			
		</table>
			
		</div>
	</div>



  </section>
 

</div>
</body>

@endsection

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
</script>
