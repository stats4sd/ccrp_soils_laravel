@extends('layouts.full_width')

@section('header')
    <link href="{{ asset('packages/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('packages/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

@include('projects.header')

<div class="card">
    <div class="card-header">
        Edit Access to Project <b>{{ $project->name }}</b>
    </div>
    <div class="card-body">
    <form method="POST" action="{{ route('projectmembers.update', [$project, $user])}}">
            @csrf
            @method('put')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-md-6 col-form-label text-md-right">
                    User Name
                </label>
                <p class="col-md-6 col-form-label">{{ $user->name }}</p>
            </div>
            <div class="form-group row">
                <label class="col-md-6 col-form-label text-md-right">
                    User Email
                </label>
                <p class="col-md-6 col-form-label">{{ $user->email }}</p>
            </div>
            <div class="form-group row required">
                <label for="select-users" class="col-md-6 col-form-label text-md-right">
                    Assign access level for Project <b>{{ $project->name }}</b>.
                </label>
                <div class="col-md-6">
                    <select
                        id="access-level"
                        name="admin"
                        class="select2 form-control @error('name') is-invalid @enderror"
                        value="{{ $user->pivot->admin }}"
                        >
                            <option value="0" {{ !$user->pivot->admin ? 'selected' : '' }}>Project Member</option>
                            <option value="1" {{ $user->pivot->admin ? 'selected' : '' }}>Project Administrator</option>

                    </select>
                    @error('users')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-10 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection