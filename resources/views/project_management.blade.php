
@extends('layouts.layout')

@section('content')

<body>
	<div class="col-sm-12">
	 	<section class="content mb-5" id="group">

	 		@foreach ($groups as $group)
		    	<h1 class="mb-5"><b>{{$group->name}}</b></h1>
	    	@endforeach

	    	<div class="container-fluid">
	    		<div class="row">
	    			<div class="col-sm-2">
				    	<div class="img_group_default">
							<img src={{url("images/535015583.jpg")}} id="avatar" >
						</div>
					</div>
					<div class="col-sm-6">

						<div id="description">
							@foreach ($groups as $group)
						    	<p>{{$group->description}}</p>
					    	@endforeach

						</div>
					</div>
					<div class="col-sm-4">
						<h3><b>{{ t("Group Admins") }}</b></h3>
						<div class="admin_group">
							@foreach ($admins as $admin)
							<a href="/name-admin" data-toggle="tooltip" title="{{$admin->name}}">
							<img src={{url("images/535015583.jpg")}} id="avatar" >
							</a>
					    	@endforeach

						
					</div>


				
					</div>
				</div>
			</div>

	    	<!-- Tab links -->
			<div class="tab mt-5">
			  <button class="tablinks" onclick="openPage(event, 'Form_data')" id="defaultOpen"><font size="2">{{ t("Form and Data") }}</font></button>
			  <button class="tablinks" onclick="openPage(event, 'Members')"><font size="2">{{ t("Members") }}</font></button>
			  <button class="tablinks" onclick="openPage(event, 'Manage')"><font size="2">{{ t("Manage") }}</font></button>
			</div>

			<div id="Form_data" class="tabcontent">
				<div class="row">
		  			<div class="container">
		  				<table>
		  					
		  				</table>

				        
		 			</div>
		   		</div>
			</div>

			<div id="Members" class="tabcontent">
			</div>

			<div id="Manage" class="tabcontent">
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
//Tooltip
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
</script>