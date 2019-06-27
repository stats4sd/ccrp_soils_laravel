
@extends('layouts.layout')

@section('content')
<body>
<div class="col-sm-8">
  <section class="content mb-5" id="generate_qr_code">
    <h3 class="mb-5"><b>{{ t("Generate QR Codes") }}</b></h3>
      <p>{{ t("Use this page to generate QR codes that aren't linked to a specific location or farmer. This is used if you are getting quickly setup, or are mainly using the toolkit to aid with analysis of samples, and are managing your data elsewhere.") }}</p>
      <p>{{ t("Click the button below to generate a sheet of 6 sample codes for printing. Every code will be unique within the system. Simply generate and print as many sheets as you need for your work.") }}</p>
      
  </section>
  <section>
    <button type="button" class="btn btn-dark"><b>{{ t("GENERATE CODE SHEET FOR PRINTING") }}</b></button>
  </section>

</div>
</body>

@endsection