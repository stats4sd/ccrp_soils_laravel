@extends('layouts.layout')

@section('content')

	@if($is_user)
		<div class="alert alert-success alert-block" id="success"><p><b>{{ t("Congratulation.") }}</b> {{ t("Now you are allow to access the") }} <a href="{{URL::to('en/projects/'.$project['slug'])}}">{{$project->name}}<a></p></div>
	@else 
		<div class="alert alert-danger alert-block" id="danger"><p><b>{{ t("You are not register.) }}</b>  {{ ("Before to continue you must") }} <a href="{{URL::to('en/'.$key_confirm.'/register')}}"> {{ t("register.2) }}</a></p></div>

	@endif

@endsection
