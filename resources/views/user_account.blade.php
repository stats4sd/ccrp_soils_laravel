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
							<img src={{url($user->avatar)}} id="avatar" >
						</div>
					</div>
					<div class="col-sm-5">
						<br>

						<div id="description">
							<p>{{$user->created_at}}</p>
						    
					    	
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
		  						
		  					</tbody>
		  					
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




@section('script')
<script type="text/javascript">	

</script>
@endsection
