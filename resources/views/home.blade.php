

@extends('layouts.layout')

@section('content')


<div class="col-sm-8">

<section class="content mb-5" id="introduction">
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
  <h3><strong>Who are we?</strong></h3>
  <p>The platform is a collaboration between the Research Methods Support team at <a href='https://stats4sd.org/'><u>Stats4SD</u></a> and the Cross-cutting Soils project funded by the McKnight foundation’s <a href='http://ccrp.org/'><u>Collaborative Crop Research Program (CCRP)</u></a>.</p>
  <p>{{ t("This website and associated resources are created by the CCRP Research Methods Support team and Cross-cutting Soils Project, in association with the")}} <a href='http://ccrp.org/'><u>Collaborative Crop Research Program</u></a>. {{ t("All data present in the platform remains the property of the individual projects using the platform.") }}</p>
</section>
</div>

</body>
@endsection




