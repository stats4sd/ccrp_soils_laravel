@extends('layouts.full_width')

@section('content')
    <h2>Change your Account Password</h2>

    <div class="card-body">
        <form method="POST" action="{{ route('users.password.update', $user )}}">
            @csrf
            @method('PUT')
            <div class="row">
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
                            Current Password
                        </label>
                        <div class="col-md-6">
                            <input
                                type="password"
                                id="current_password"
                                name="current_password"
                                class="form-control @error('name') is-invalid @enderror"
                                required
                                autocomplete="password">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <hr/>

                    <div class="form-group row required">
                        <label for="new_password" class="col-md-4 col-form-label text-md-right">
                            New Password
                        </label>
                        <div class="col-md-6">
                            <input
                                type="password"
                                id="new_password"
                                name="new_password"
                                class="form-control @error('new_password') is-invalid @enderror"
                                required
                                autocomplete="password">

                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row required">
                        <label for="confirm_password" class="col-md-4 col-form-label text-md-right">
                            Confirm New Password
                        </label>
                        <div class="col-md-6">
                            <input
                                type="password"
                                id="confirm_password"
                                name="confirm_password"
                                class="form-control @error('confirm_password') is-invalid @enderror"
                                required
                                autocomplete="password">

                            @error('confirm_password')
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