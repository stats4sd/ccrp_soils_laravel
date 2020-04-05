@extends('layouts.two_panel')

@section('header')
    <h1 class="display-5 text-black mt-5 mb-2">{{ t("About") }}</h1>
    <p class="lead text-black-50">How the platform works</p>

@endsection

@section('content')

<div class="col-sm-12">
  <p>{{ t("There are three main components to this data platform:") }}</p>
  <ul>
    <li>{{ t("A set of ODK forms for use when collecting and analysing soil samples;") }}</li>
    <li>{{ t("A QR Code generation tool, to help you uniquely identify and manage your physical samples;") }}</li>
    <li>{{ t("A MySQL Database that helps organise data collected through the different forms.") }}</li>
  </ul>
  <p>{{ t("You can use these components in different ways, described below.") }}</p>

    <section class="content mb-5" id="whoweare">
      <h3><strong>{{ t("1. Register to use the platform’s database") }}</strong></h3>
      <p>{{ t("Registering on the site will give you access to the full set of tools, including the ability to collect data via your own Kobotoolbox account, have it synchronised to the platform, and then automatically merged into downloadable datasets.") }}</p>
      <p>{{ t("To make full use of the platform, you need to have a kobotoolbox account for your project – if you don’t have one, you can set one up easily at") }} <a href="https://kf.kobotoolbox.org">https://kf.kobotoolbox.org</a>. {{ t("This platform integrates with Kobotoolbox to let you collect soil sample and analysis data with the same tools you use for other data collection activities.") }}</p>
      <p>{{ t("To get started, use the links in the sidebar to register a new project account. The RMS or Soils team will be notified and will be able to confirm your account and help you get started.") }}</p>
    </section>

    <section class="content mb-5" id="whoweare">
      <h3><strong>{{ t("2. Just use the ODK forms") }}</strong></h3>
      <p>{{ t("Using the downloadable resources requires no sign-up, simply download the XLS forms you wish to use from our downloads page.") }}</p>
      <p>{{ t("The different analysis protocols all require some level of calculation. The ODK forms we have developed have these calculations programmed in, to help save time and reduce the chance of errors in your results.") }}</p>
      <p>{{ t("The analysis forms require you to scan a QR or barcode at the start of the process, to identify your soil sample. We highly recommend using QR codes for uniquely identifying your physical samples, as they can be printed out and kept with the sample. See the QR code generation page for more information.") }}</p>
      <p>{{ t("To see all the forms available and choose ones to download, go to our downloads page.") }}</p>
    </section>
</div>
@endsection
