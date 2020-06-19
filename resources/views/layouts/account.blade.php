<div class="card account-card m-3">
    <div class="card-header">
        <strong>{{ t("MY ACCOUNT") }}</strong>
    </div>
    @if(auth()->check())
        <div class="card-body">
            <form method="post" action="{{ route('logout') }}">
                @csrf

                <div class="img_group mb-3">
                    <a href="{{ route('users.show', Auth::user()) }}">
                        <img src="{{ url(Auth::user()->avatar)  }}" id="user-avatar" >
                        <strong>{{ Auth::user()->name }}</strong>
                    </a>
                </div>

                <button type="submit" class="btn btn-dark btn-block " name="login_user">{{ t("Logout") }}</button>
            </form>
        </div>

        <div class="card-header">
            <strong>{{ t("MY PROJECTS") }}</strong>
        </div>
        <ul class="list-group list-group-flush">
            @foreach($userProjects as $project)
                <div class="list-group-item">
                    <a href="{{ route('projects.show', $project) }}">
                        <div class="img_group">
                            <img src="{{ url($project->avatar) }}" alt="Person" width="96" height="96" class="mr-4">
                            {{ $project->name }}
                        </div>
                    </a>
                </div>
            @endforeach
        </ul>
    @else
        <div class="card-body">
            <form method="post" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">{{ t("Email") }}</label>
                    <input class="form-control"  type="text" name="email">

                    @if($errors->has('email'))
                        <span class="" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{ t("Password") }}</label>
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
                            <input class="form-check-input" type="checkbox"> {{ t("Remember Password") }}
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-dark btn-block" name="login_user">{{  t("Login") }}</button>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href={{ route('register') }}>{{ t("Register an Account") }}</a>
                <a class="d-block small" href={{ route('password.request') }}>{{ t("Forgot Password?") }}</a>
            </div>
        </div>
    @endif
</div>
