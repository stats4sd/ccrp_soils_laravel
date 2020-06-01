@extends('layouts.app')

@section('main')
    {{-- Header --}}
    <header class="bg-soils py-3 mb-5">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-lg-12">
                    @yield('header')
                </div>
            </div>
        </div>
    </header>
    <div class="container my-4">
        <div class="row">
            <div class="col-lg-8">
                @yield('content')
            </div>
            {{-- Sidebar --}}
            <div class="col-lg-4">
                @include('layouts.account')
            </div>
        </div>
    </div>
@endsection