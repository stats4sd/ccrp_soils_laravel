
@extends('layouts.layout')

@section('content')
<div class="row">
	<div class="col-sm-12">
	 	<section class="content mb-5" id="group">
			<h1 class="mb-5"><b>{{ t("Projects") }}</b></h1>

	    	<!-- Tab links -->
			<div class="tab mt-5">
			  <button class="tablinks" onclick="openPage(event, 'All_Projects')" id="defaultOpen"><font size="2">{{ t("All Projects") }}</font></button>
			  <button class="tablinks" onclick="openPage(event, 'My_Projects')"><font size="2">{{ t("My Projects") }}</font></button>
			  <a href="/en/create-project">
			  <button class="tablinks"><font size="2">{{ t("Create Project") }}</font></button>
			</a>
			</div>

			<div id="All_Projects" class="tabcontent">
				@if(!empty($projects))
					<div class="alert alert-info" role="alert">
						{{ t("There are not project in the platform") }}
					</div>
				@endif
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
									<p class="card-text"><small class="text-muted">{{$project->created_at}}</small></p>
								</div>
						    </div>
						</div>	
	          		</div>
	    		        
	  			@endforeach
		   		
			</div>
			<div id="My_Projects" class="tabcontent">
				@if(!empty($projects))
					<div class="alert alert-info" role="alert">
						{{ t("There are not project in your account. Please go in the 'Create Project' section for creating one.") }}
					</div>
				@endif		
	   		    @foreach($myprojects as $project)
	   		     
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
	    </section>
	</div>
</div>
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


</script>