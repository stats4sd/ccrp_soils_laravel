@extends('two_panel')
@section('content')
<div class="container">
    <div class="my-5">
        <h2>Contact Us</h2>
        <p>Have questions about the platform, or need some direct support for your CCRP Project? Use the form below to contact the RMS and Soils Cross-cutting teams. We will respond as soon as possible.</p>
        <hr/>
    </div>

    @if(Session::has('success'))
       <div class="alert alert-success">
            {{ Session::get('success') }}
       </div>
    @endif
    {!! Form::open(['route'=>'contact.store']) !!}

    @if(env('GOOGLE_RECAPTCHA_KEY'))
        <div class="form-group {{ $errors->has('g-recaptcha-response') ? 'has-error' : '' }}">
            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
        </div>
    @endif

    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        {!! Form::label('Name:') !!}
        {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Enter Name']) !!}
        <span class="text-danger">{{ $errors->first('name') }}</span>
    </div>
    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        {!! Form::label('Email:') !!}
        {!! Form::text('email', old('email'), ['class'=>'form-control', 'placeholder'=>'Enter Email']) !!}
        <span class="text-danger">{{ $errors->first('email') }}</span>
    </div>
    <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
        {!! Form::label('Message:') !!}
        {!! Form::textarea('message', old('message'), ['class'=>'form-control', 'placeholder'=>'Enter Message']) !!}
        <span class="text-danger">{{ $errors->first('message') }}</span>
    </div>
    <div class="form-group">
        <button class="btn btn-stats">Contact Us</button>
    </div>

    {!! Form::close() !!}
</div>


@endsection