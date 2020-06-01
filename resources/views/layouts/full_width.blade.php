@extends('layouts.app')

@section('main')
    <!-- Header -->
  <header class="bg-soils py-5 mb-5">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-lg-12">
            @yield('header')
        </div>
      </div>
    </div>
  </header>

  <!-- Page Content -->
  <div class="container">
    @yield('content')
  </div>
@endsection