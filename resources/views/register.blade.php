
@extends('layouts.app')

@section('content')
  <body>
    <div class="col-sm-8">

    <section class="content mb-5" id="create_account">
      <h1><b>{{ t("Create an Account") }}</b></h1>
        <p>{{ t("Registering for this site is easy. Just fill in the fields below, and we'll get a new account set up for you in no time.") }}</p>
      <div class="row">
        <div class="col-sm-6">
          <h3 class="content mb-3"><b>{{ t("Account Details") }}</b></h3>
          <form method="post" action="{{ url('en/register/store')}}">
            {{csrf_field()}}
            <div class="form-group">
              <label><b>{{ t("Username (required)") }}</b></label>
              <input class="form-control"  type="text" name="username" value="{{ old('username') }}">
              @if($errors->has('username'))
                <span class="" role="alert">
                    <strong style="color: #a22a2a;">{{ $errors->first('username') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group">
              <label ><b>{{ t("Email Address (required)") }}</b></label>
                <input class="form-control"  type="email" name="email" value="{{ $email ? $email : old('email') }}">
              @if($errors->has('email'))
                <span class="" role="alert">
                    <strong style="color: #a22a2a;">{{ $errors->first('email') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group">
              <label><b>{{ t("Choose a Password (required)") }}</b></label>
              <input class="form-control" type="password" name="password">
              @if($errors->has('password'))
                <span class="" role="alert">
                    <strong style="color: #a22a2a;">{{ $errors->first('password') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group">
              <label><b>{{ t("Confirm Password (required)") }}</b></label>
              <input class="form-control" type="password" name="password_confirm">
               @if($errors->has('password'))
                <span class="" role="alert">
                    <strong style="color: #a22a2a;">{{ $errors->first('password') }}</strong>
                </span>
              @endif
            </div>
            <button type="submit" class="btn btn-dark btn-block">{{ t("Complete Sign Up") }}</button>

        </div>

        <div class="col-sm-6">
          <h3 class="content mb-3"><b>{{ t("Profile Details") }}</b></h3>
          <div class="form-group">
            <label><b>{{ t("Name (required)") }}</b></label>
              <input class="form-control"  type="text" name="name" value="{{ old('name') }}">
               @if($errors->has('name'))
               <span class="" role="alert">

                    <strong style="color: #a22a2a;">{{ $errors->first('name') }}</strong>

              </span>
              @endif
          </div>
          <div class="form-group">
            <label><b>{{ t("Kobotools Account")}}</b></label>
            <input class="form-control" type="text" name="kobo_id">
          </div>

          <br>
          <label><b>{{ t("Who can see this field?") }}</b></label>
          <div class="choice">
            <input id="choice_1" type="radio" name="privacy" value="Everyone" checked/>
            <label for="choice_1">{{ t("Everyone") }}</label>
          </div>

          <div class="choice">
            <input id="choice_2" type="radio" name="privacy" value="Only Me" />
            <label for="choice_2">{{ t("Only Me") }}</label>
          </div>

          <div class="choice">
            <input id="choice_3" type="radio" name="privacy" value="All Members" />
            <label for="choice_3">{{ t("All Members") }}</label>
          </div>
        </div>

      </form>
      </div>
    </div>
  </body>

@endsection