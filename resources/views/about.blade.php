@extends('layouts.two_panel')

@section('header')
    <h1 class="display-5 text-black mt-5 mb-2">{{ t("About") }}</h1>
    <p class="lead text-black-50">{{ t("How the platform works") }}</p>

@endsection

@section('content')

<div class="col-sm-12">

{!!  app('commonmark')->convertToHtml(t(<<<EOD

There are three main components to this data platform:
- A set of ODK forms for use when collecting and analysing soil samples;
- A QR code generation tool, to help you uniquely identify and manage your physical samples;
- A MySQL databse that helps organise data collected through the different forms.

You can use these components in different ways, described below.

### 1. Register to use the platform's database
Registering on the site will give oyu access to the full set of tools, including the ability to collect data via your own Kobotoolbox account, have it synchronised on the platform, and the nautomatically merged into downloadable datasets for your project.

To get started, use the links in the header or sidebar to register for an account. Once registered, you can add your CCRP project to the platform, or request to join if it already exists.

When a new project account is created, the RMS and Soils team will be notified and will contact you to offer support on getting started. You can also contact us directly through the platform, and we will respond as soon as possible.

### 2. Just use the ODK forms and QR codes; keep the data in your own system.

Using the downloadable resources requires no sign-up. Simply download the XLS forms you wish to use from our downloads page.

The different analysis protocols all require some level of calculation. The ODK forms have these calculations programmed in, so using them for analysis will improve the reliability of your data even if you choose not to use this platform. We are also regularly updating these forms, and many now have guidance on how to interpret your results directly within the form.

We recommend using QR codes to uniquely identify your soil samples, even if you do not plan to store the physical samples after your analysis. This is to avoid potential typing errors when entering sample IDs into the different analysis forms. You can generate pages of unique QR codes on this platform without registering.

To see all the forms available, go to our downloads page.
EOD)) !!}
</div>
@endsection
