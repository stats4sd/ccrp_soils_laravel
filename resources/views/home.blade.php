@extends('layouts.full_width')

@section('header')
    <h1 class="display-4 text-black mt-5 mb-2">{{ t("CCRP Soils Data Platform") }}</h1>
    <p class="lead mb-5 text-black-50">{{ t("Providing a low cost, simplified means to quantify soil contexts and change") }}</p>
@endsection

@section('content')

<div class="d-flex flex-column justify-content-center">

    <section class="hero-section">
        <div class="container h-100">
            <div class="hero-content">
                <div class="row justify-content-center mt-5">
                        <div class="col-xl-3 col-md-4 px-0 mx-0 order-2 order-md-1 d-flex flex-row justify-content-center">
                            <div>

                                <a href="{{ route('about') }}" class="btn btn-lg d-flex flex-column justify-content-center text-center">
                                    <i class="fas fa-sitemap pb-4" style="font-size:5em"></i>
                                    {{ t("About the Platform") }}
                                </a>

                            </div>
                        </div>
                        <div class="col-xl-3 col-md-4 px-0 mx-0 order-1 order-md-2 d-flex flex-row justify-content-center">
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg d-flex flex-column justify-content-center text-center">
                                <i class="fas fa-user-alt pb-4" style="font-size:5em"></i>
                                {{ t("Login / Register") }}
                            </a>
                        </div>
                        <div class="col-xl-3 col-md-4 px-0 mx-0 order-3 order-md-3 d-flex flex-row justify-content-center">
                            <a href="{{ route('contact') }}" class="btn btn-lg d-flex flex-column justify-content-center text-center">
                                <i class="fas fa-comment-alt pb-4" style="font-size:5em"></i>
                                {{ t("Contact Us") }}
                            </a>
                        </div>
                </div>
            </div>
        </div>
    </section>

    <div class="row justify-content-center">
        <div class="col-xl-9 col-md-12">
            <div class="card mb-4">
                <div class="card-body">


{!!  app('commonmark')->convertToHtml(t("

This soils platform is the result of a collaboration between the [Soils](https://smallholder-sha.org/) and the [Research Methods Support](https://stats4sd.org/ccrp) teams, a pair of cross-cutting projects from the [Collaborative Crop Research Program (CCRP)](https://ccrp.org).

")) !!}
                </div>

            </div>
        </div>
    </div>


    <img src="https://smallholdersha.files.wordpress.com/2020/01/texture_damasiko-1.jpg" class="mx-auto"/>


</div>
@endsection




