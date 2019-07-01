
@extends('layouts.layout')

@section('content')
<body>
<div class="col-sm-8">
  <section class="content mb-5" id="generate_qr_code">
    <h3 class="mb-5"><b>{{ t("Group") }}</b></h3>
	<!-- Tab links -->
	<div class="tab">
	  <button class="tablinks" onclick="openPage(event, 'Details')" id="defaultOpen">{{ t("1.Details") }}</button>
	  <button class="tablinks" onclick="openPage(event, 'Settings')">{{ t("2. Settings") }} </button>
	  <button class="tablinks" onclick="openPage(event, 'Photo')">{{ t("3. Photo") }} </button>
	  <button class="tablinks" onclick="openPage(event, 'Invites')">{{ t("4. Send Invites") }} </button>
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
		           	<div class="form-group">
		             	<label for="exampleInputEmail1"><b>{{ t("Kobotoolbox Account username") }}</b></label>
		             	<input class="form-control"  type="text" name="group_name">
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


	</div>

	<div id="Invites" class="tabcontent">
	  <h3>Tokyo</h3>
	  <p>Tokyo is the capital of Japan.</p>
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
document.getElementById("defaultOpen").click();

</script>