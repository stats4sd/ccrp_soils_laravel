@extends('layouts.full_width')

@section('content')
    <h2>Manage your account</h2>
    <p>Use this page to manage your account details.</p>

    <div class="card">
        <div class="card-header">Account Details</div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('users.update', $user )}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-3">
                    <figure class="img_group_default">
                        <img src="{{url($user->avatar)}}" id="avatar">
                        <figcaption class="figure-caption" id="avatar-caption"></figcaption>
                    </figure>
                </div>
                <div class="col-sm-9">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group row required">
                        <label for="name" class="col-md-4 col-form-label text-md-right">
                            Name
                        </label>
                        <div class="col-md-6">
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') ?: $user->name }}"
                                required
                                autocomplete="name">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row required">
                        <label for="email" class="col-md-4 col-form-label text-md-right">
                            Email
                        </label>
                        <div class="col-md-6">
                            <input
                                type="text"
                                id="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') ?: $user->email }}"
                                required
                                autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">
                            Kobotoolbox Username
                        </label>
                        <div class="col-md-6">
                            <input
                                type="text"
                                id="kobo_id"
                                name="kobo_id"
                                class="form-control @error('kobo_id') is-invalid @enderror"
                                value="{{ old('kobo_id') ?: $user->kobo_id }}"
                                autocomplete="email">

                            @error('kobo_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="avatar" class="col-md-4 col-form-label text-md-right">
                            Replace User Picture
                        </label>
                        <div class="col-md-6">
                            <input
                                type="file"
                                id="avatar"
                                class="form-control-file @error('avatar') is-invalid @enderror"
                                name="avatar"
                                onchange="preview_image(event)"
                            >

                            @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0 ">
                        <div class="col-md-10 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>

    </div>


@endsection

@section('scripts')

<script type='text/javascript'>
    function preview_image(event)
    {
        var reader = new FileReader();
        reader.onload = function()
        {
            var output = document.getElementById('avatar');
            var outputLabel = document.getElementById('avatar-caption');
            output.src = reader.result;
            outputLabel.innerHTML = "Preview of image to upload";
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection