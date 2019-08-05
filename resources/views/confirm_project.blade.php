@extends('layouts.layout')

@section('content')

	@if($is_user)
		<div class="alert alert-success alert-block" id="success"><p><b>Congratulation.</b> Now you are allow to access the <a href="{{URL::to('en/projects/'.$project['slug'])}}">{{$project->name}}<a></p></div>
	@else 
		<div class="alert alert-danger alert-block" id="danger"><p><b>You are not register.</b> Before to continue you must <a href="{{URL::to('en/register')}}">register.</a></p></div>

	@endif

@endsection
