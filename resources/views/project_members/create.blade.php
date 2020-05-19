@extends('layouts.full_width')

@section('content')

@include('projects.header')

<div class="card">
    <div class="card-header">
        <b>Add new members to {{ $project->name }}</b>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('projectmembers.store')}}">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h4>Invite New Members</h4>
            <div class="form-group row required">
                <label for="select-users" class="col-md-4 col-form-label text-md-right">
                    Add existing platform users
                </label>
                <div class="col-md-8">
                    <select
                        data-placeholder="select users to invite"
                        multiple
                        id="select-users"
                        name="users"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        >
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('users')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row required">
                <label for="description" class="col-md-4 col-form-label text-md-right">
                    If you cannot find the users on the platform, you can send them an email invitation to join the platform (and this project).<br/><br/>
                    Enter the email addresses to send invites to. You can add as many email addresses as you need.
                </label>
                <div class="col-md-8">
                    <div id="repeatingEmailFields">
                        <div class="entry input-group col-xs-3">
                            <input class="form-control" name="fields[]" type="text" placeholder="Placeholder" />
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-success btn-lg btn-add">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                    <br>
                    <small>Press <span class="glyphicon glyphicon-plus gs"></span> for another field</small>
                    @error('fields')
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

@push('scripts')
    <script>
        //shamelessly copied from https://nddt-webdevelopment.de/bootstrap/repeater-field-bootstrap
        $(function()
        {
            $(document).on('click', '.btn-add', function(e)
            {
                e.preventDefault();
                var controlForm = $('#repeatingEmailFields:first'),
                    currentEntry = $(this).parents('.entry:first'),
                    newEntry = $(currentEntry.clone()).appendTo(controlForm);
                newEntry.find('input').val('');
                controlForm.find('.entry:not(:last) .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('');
            }).on('click', '.btn-remove', function(e)
            {
                e.preventDefault();
                $(this).parents('.entry:first').remove();
                return false;
            });
        });
