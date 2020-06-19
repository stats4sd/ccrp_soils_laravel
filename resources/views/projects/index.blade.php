@extends('layouts.two_panel')

@section('content')
<div class="row">
	<div class="col-sm-12">
	 	<section class="content mb-5" id="group">
			<h1 class="mb-5"><b>{{ t("Projects on the Platform") }}</b></h1>

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
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

	    </section>
	</div>
</div>
@endsection

