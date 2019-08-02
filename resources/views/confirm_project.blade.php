@extends('layouts.layout')

@section('content')
<div class="alert alert-success alert-block" id="success"><p><b>Congratulation.</b> Now you are allow to access the <a href="{{URL::to('en/projects/'.$project['slug'])}}">{{$project->name}}<a></p></div>
@endsection
