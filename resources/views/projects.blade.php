
@extends('layouts.layout')

@section('content')

<body>
	<div class="row">
	<div class="col-sm-8">
	 	<section class="content mb-5" id="group">

	 		
			<h1 class="mb-5"><b>Projects</b></h1>

	    	<!-- Tab links -->
			<div class="tab mt-5">
			  <button class="tablinks" onclick="openPage(event, 'All_Projects')" id="defaultOpen"><font size="2">{{ t("All Projects") }}</font></button>
			  <button class="tablinks" onclick="openPage(event, 'My_Projects')"><font size="2">{{ t("My Projects") }}</font></button>
			  <a href="/en/create-project">
			  <button class="tablinks"><font size="2">{{ t("Create Project") }}</font></button>
			</a>
			</div>

			<div id="All_Projects" class="tabcontent">
				@foreach($projects as $project)
       		     
	          		<div class="img_group mb-3">
	          				
	          			<div class="row mb-3">
	          				<div class="col-sm-2">
	          					<a href="projects/{{$project->slug}}">
			            		<img src={{$project->image}} alt="Person" width="96" height="96"></a>
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
			<div id="My_Projects" class="tabcontent">
						
       		    @foreach($myprojects as $project)
       		     
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

			

	    </section>
	</div>
	
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


</script>