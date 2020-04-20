<div class="card account-card m-3">
    <div class="card-header">
        <strong>MY ACCOUNT</strong>
    </div>
    <div class="card-body">
        @if(auth()->check())
            <form method="post" action="{{ url(app()->getLocale()).'\logout'}}">
                @csrf

                <div class="img_group mb-3">
                    <a href="{{url(app()->getLocale().'/users/'.Auth::user()->slug)}}"><img src="{{Auth::user()->avatar}}" id="avatar" >
                        <strong>{{ Auth::user()->username}}</strong>
                    </a>
                </div>

                <button type="submit" class="btn btn-dark btn-block " name="login_user">Logout</button>
            </form>

            <div class="card-header">
                <strong>MY PROJECTS</strong>
            </div>
            <div class="card-body">
                @if(auth()->check())
                @foreach($array_projects as $prop)
                <a href="{{url(app()->getLocale().'/projects/'.$prop['slug'])}}">
                    <div class="img_group mb-3">
                        <img src="{{$prop['image']}}" alt="Person" width="96" height="96">
                        {{$prop['name']}}
                    </div>
                </a>

                @endforeach
                @endif
            </div>
        @else
            <form method="post" action="{{ route('login', app()->getLocale()) }}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input class="form-control"  type="text" name="email">

                    @if($errors->has('email'))
                        <span class="" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input class="form-control"  type="password" name="password">

                    @if($errors->has('password'))
                    <span class="" role="alert">
                        <strong>{{ $errors->first('password')  }}</strong>
                    </span>
                    @endif

                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox"> Remember Password
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-dark btn-block" name="login_user">Login</button>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href={{url(app()->getLocale().'\register')}}>Register an Account</a>
                <a class="d-block small" href={{url(app()->getLocale().'\password\reset')}}>Forgot Password?</a>
            </div>
        @endif
    </div>
</div>
