@extends('layouts.layout')

@section('content')
<body>
	<div class="col-sm-10">
		<section class="content mb-5" id="generate_qr_code">
			<h3 class="mb-5"><b>{{ t("Generate QR Codes") }}</b></h3>
			<p>{{ t("Use this page to generate QR codes that aren't linked to a specific location or farmer. This is used if you are getting quickly setup, or are mainly using the toolkit to aid with analysis of samples, and are managing your data elsewhere.") }}</p>
			<p>{{ t("Click the button below to generate a sheet of 6 sample codes for printing. Every code will be unique within the system. Simply generate and print as many sheets as you need for your work.") }}</p>
		</section>
		<div class="visible-print">

		</div>
		<div class="card card-primary">
			<div class="card-body">

				<form method="post" action="{{ url(session()->get('locale') . '/qr-newcodes') }}">
					@csrf
					<div class="form-group row">
						<label for="qrNumber" class="col-sm-4">How many QR codes do you need?</label>
						<div class="col-sm-4">
							<input type="number" class="form-control" id="qrNum" name="qrNum">
							<small id="passwordHelpBlock" class="form-text text-muted">QR Codes will be split over multiple pages as necessary</small>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4 offset-4">
							<button type="submit" class="btn btn-dark"><b>{{ t("GENERATE CODE SHEET FOR PRINTING") }}</b></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
@endsection