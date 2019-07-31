
@extends('layouts.layout')

@section('content')
<body>
<div class="col-sm-8">
<section class="content mb-5" id="introduction">
  <h1 class="mb-5"><strong>{{ t("Start Sampling") }}</strong></h1>
  <h3><strong>{{ t("Option 1 – use this data platform") }}</strong></h3>
  <p>{{ t("For more information on the platform, how it’s built and how it can help your data collection and processing for soil data, see the About page.") }}</p>
  <p>{{ t("To collect data through this platform, please do the following:") }}</p>
  <ol>
    <li>{{ t("Check that you have added your Kobotoolbox username to your project.") }}</li>
    <li>{{ t("Go to the Data Management page, to create a set of forms and see data you have collected.") }}</li>
  </ol>

  <h3 class="mt-5"><strong>{{ t("Option 2 – use your own system") }}</strong></h3>
  <p>{{ t("To start sampling using our forms within your own data management system, you will need to:") }}</p>
  <ul>
    <li>{{ t("Download the XLS forms from our downloads page") }}</li>
    <li>{{ t("Upload them to your ODK Aggregate service. (e.g. Kobotoolbox, Ona.io, SurveyCTO).") }}</li>
    <li>{{ t("Use our QR generation tool to create QR codes for your soil samples.") }}</li>
  </ul>
</section>
</div>
</body>
@endsection
