@extends('layouts.full_width')

@section('header')
    <h1 class="display-4 text-black mt-5 mb-2">CCRP Soils Data Platform</h1>
    <p class="lead mb-5 text-black-50">Providing a low cost, simplified means to quantify soil contexts and change</p>
@endsection

@section('content')

<div class="d-flex flex-column justify-content-center">

    <section class="hero-section">
        <div class="container h-100">
            <div class="hero-content">
                <div class="row justify-content-center mt-5">
                        <div class="col-xl-3 col-md-4 px-0 mx-0 order-2 order-md-1 d-flex flex-row justify-content-center">
                            <div class="">

                                <a href="{{ route('about') }}" class="btn btn-lg d-flex flex-column justify-content-center text-center">
                                    <i class="fas fa-sitemap pb-4" style="font-size:5em"></i>
                                    About the Platform
                                </a>

                            </div>
                        </div>
                        <div class="col-xl-3 col-md-4 px-0 mx-0 order-1 order-md-2 d-flex flex-row justify-content-center">
                            <a href="{{ url('login') }}" class="btn btn-primary btn-lg d-flex flex-column justify-content-center text-center">
                                <i class="fas fa-user-alt pb-4" style="font-size:5em"></i>
                                Login / Register
                            </a>
                        </div>
                        <div class="col-xl-3 col-md-4 px-0 mx-0 order-3 order-md-3 d-flex flex-row justify-content-center">
                            <a href="{{ url('contact') }}" class="btn btn-lg d-flex flex-column justify-content-center text-center">
                                <i class="fas fa-comment-alt pb-4" style="font-size:5em"></i>
                                Contact Us
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
                    <p>This soils platform is the result of a collaboration between <a href="https://smallholder-sha.org/">the Soils</a> and the <a href="stats4sd.org/ccrp">Research Methods Support</a> teams, a pair of cross-cutting projects from the <a href="ccrp.org">Collaborative Crop Research Program (CCRP)</a>.</p>
                </div>
            </div>
        </div>
    </div>


    <img src="https://smallholdersha.files.wordpress.com/2020/01/texture_damasiko-1.jpg" class="mx-auto"/>


        {{-- <section class="content mb-5" id="introduction">
            <h1>{{ t("Introduction") }}</h1>
            <p>{{ t("This data platform is intended to help CCRP research projects collect and organise their soil sample data.") }}</p>
            <p>{{ t("Using the tools within the platform will help you:") }}</p>
            <ul>
                <li>{{ t("Uniquely identify each soil sample your project collects with a QR code.") }}</li>
                <li>{{ t("Enter data about the soil samples, such as location, date of sampling and other key information.") }}</li>
                <li>{{ t("Enter readings from your soil analyses and automatically calculate the results.") }}</li>
                <li>{{ t("Save the readings and results to a secure database.") }}</li>
                <li>{{ t("Automatically merge results from different analyses with your main sample information into a single dataset.") }}</li>
            </ul>
            <p>{{ t("If you work with soils, and are interested in using the Soil Health Assessment Toolkit developed by the team at")}} <a href='https://smallholder-sha.org/'><u>smallholder-sha.org</u></a>,{{ t("we recommend exploring this platform to see how these tools can help your workflow.") }}</p>
        </section>

        <section class="content mb-5" id="whoweare">
            <h3><strong>{{ t("Who are we?") }}</strong></h3>
            <p>{{ t("The platform is a collaboration between the Research Methods Support team at") }} <a href='https://stats4sd.org/'><u>Stats4SD</u></a> {{ t("and the Cross-cutting Soils project funded by the McKnight foundation’s") }}<a href='http://ccrp.org/'><u>Collaborative Crop Research Program (CCRP)</u></a>.</p>
            <p>{{ t("This website and associated resources are created by the CCRP Research Methods Support team and Cross-cutting Soils Project, in association with the")}} <a href='http://ccrp.org/'><u>Collaborative Crop Research Program</u></a>. {{ t("All data present in the platform remains the property of the individual projects using the platform.") }}</p>
        </section>
 --}}
</div>
@endsection




