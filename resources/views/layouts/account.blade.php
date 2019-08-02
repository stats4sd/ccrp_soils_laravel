<!doctype html>
 
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 
  <title>CCRP Soils Data Platform</title>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>

<div class="row">
  <div class="container">
     <div class="card card-login mx-5 mt-5">
       <div class="card-header"><strong>MY ACCOUNT</strong></div>
       <div class="card-body">
         <form method="post" action="{{ url('logout') }}">
          @csrf
         
          <div class="img_group mb-3">
              <img src={{Auth::user()->avatar}} id="avatar" >
              <strong>{{ Auth::user()->username}}</strong>
            </div>
           
          
           <button type="submit" class="btn btn-dark btn-block " name="login_user">Logout</button>
         </form>
 
       </div>
       <div class="card-header"><strong>MY PROJECTS</strong></div>
      <div class="card-body">
        @if(auth()->check())
          @foreach($array_projects as $prop)
            <a href="/en/projects/{{$prop['slug']}}">     
              <div class="img_group mb-3">
                <img src="{{$prop['image']}}" alt="Person" width="96" height="96">
              {{$prop['name']}}
              </div>
            </a> 
           
          @endforeach
        @endif
      </div>   
    
     </div>
   </div>

</div>


</body>




