
@extends('layouts.layout')

@section('content')
  <body>
    <div class="col-sm-8">

    <section class="content mb-5" id="create_account">
      <h1><b>{{ t("Create an Account") }}</b></h1>
      <p>{{ t("Registering for this site is easy. Just fill in the fields below, and we'll get a new account set up for you in no time.") }}</p>
      <div class="row">
      <div class="col-sm-6">
        <h3 class="content mb-3"><b>{{ t("Account Details") }}</b></h3>
        <form method="post" action="{{ url('home/checklogin')}}">
          {{csrf_field()}}
           <div class="form-group">
             <label><b>{{ t("Username (required)") }}</b></label>
             <input class="form-control"  type="text" name="username">
           </div>
           <div class="form-group">
             <label ><b>{{ t("Email Address (required)") }}</b></label>
             <input class="form-control"  type="email" name="email">
           </div>
           <div class="form-group">
            <label><b>{{ t("Choose a Password (required)") }}</b></label>
            <input class="form-control" type="password" name="password">
           </div>
           <div class="form-group">
            <label><b>{{ t("Confirm Password (required)") }}</b></label>
            <input class="form-control" type="password" name="password">
           </div>
           <button type="submit" class="btn btn-dark btn-block" name="sign_up">{{ t("Complete Sign Up") }}</button>
         </form>

      </div>
        <div class="col-sm-6">
          <h3 class="content mb-3"><b>{{ t("Profile Details") }}</b></h3>
          <div class="form-group">
          <label><b>{{ t("Name (required)") }}</b></label>
            <input class="form-control"  type="text" name="username">
          </div>
          <label style="color: grey;"><em><b>{{ t("This field can be seen by:") }}</em> {{ t("Everyone") }}</b></label> <button type="button" style="color: grey;" class="btn-xs">{{ t("change") }}</button>
          <label><b>{{ t("Who can see this field?") }}</b></label>
          <div class="choice">
            <input id="choice_1" type="radio" name="choice" value="everyone" />
            <label for="choice_1">{{ t("Everyone") }}</label>
          </div>

          <div class="choice">
            <input id="choice_2" type="radio" name="choice" value="only_me" />
            <label for="choice_2">{{ t("Only Me") }}</label>
          </div>

          <div class="choice">    
            <input id="choice_3" type="radio" name="choice" value="all_members" />
            <label for="choice_3">{{ t("All Members") }}</label>
          </div>
        </div>
      </div>
    </div>      
  </body>
    
@endsection