
@extends('layouts.layout')

@section('content')
<body>
	<div class="col-sm-8">
		<section class="content mb-5" id="generate_qr_code">
		  <h3 class="mb-5"><b>{{ t("Downloads") }}</b></h3>
		  <p>{{ t("This page contains links to find and download resources to help you during your soil analysis. Full details of each analysis process can be found at") }} <a href="https://smallholder-sha.org/"> https://smallholder-sha.org/</a>.</p>
		</section>
		@foreach($xlsforms as $xlsform)
			<section class="mb-5">
			  <h4 class="mb-4"><b>{{$xlsform->form_title}}:</b></h4>
			  <p>{{$xlsform->description}}</p>
			  <p><a href="{{$xlsform->link_page}}"><u>{{ t("View protocol online") }}</u></a> {{ t("(redirects to smallholder.sha.org)") }}</p>
			  <p><a href="uploads/{{$xlsform->form_id}}"><u>{{ t("Download") }} {{$xlsform->form_title}} {{ t("form") }}</u></a></p> 
			</section>
		@endforeach
		
	</div>
</body>
@endsection

