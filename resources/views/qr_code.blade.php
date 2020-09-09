@extends('layouts.two_panel')

@section('content')
<body>
	<div class="col-sm-10">
		<section class="content mb-5" id="generate_qr_code">
			<h3 class="mb-5"><b>{{ t("Generate QR Codes") }}</b></h3>
			<p>{{ t("Use this page to generate QR codes that aren't linked to a specific location or farmer. This is used if you are getting quickly setup, or are mainly using the toolkit to aid with analysis of samples, and are managing your data elsewhere.") }}</p>
			<p>{{ t("Click the button below to generate a sheet of sample codes for printing. Every code will be unique within the system. Simply generate and print as many sheets as you need for your work.") }}</p>
		</section>
		<div class="visible-print">

		</div>
		<div class="card card-primary">
			<div class="card-body">

				<form method="post" action="{{ route('qr-newcodes') }}">
					@csrf
					<div class="form-group row {{ $errors->has('prefix') ? 'has-error' : '' }}">
						<label for="prefix" class="col-sm-4">{{ t("Enter the prefix to use for the codes") }}</label>
						<div class="col-sm-4">
						<input type="text" class="form-control" id="prefix" name="prefix" onkeyup="standardCode()">
                        <span class="text-danger">{{ $errors->first('prefix') }}</span>
						</div>
					</div>
					<div class="form-group row {{ $errors->has('code_number') ? 'has-error' : '' }}">

						<label for="code_numberber" class="col-sm-4">{{ t("How many QR codes do you need?") }}</label>
						<div class="col-sm-4">
							<input type="number" class="form-control" id="code_number" name="code_number">
							<small id="passwordHelpBlock" class="form-text text-muted">{{ t("QR Codes will be split over multiple pages as necessary") }}</small>
                            <span class="text-danger">{{ $errors->first('code_number') }}</span>

						</div>
					</div>
					<div class="form-group row {{ $errors->has('label_number') ? 'has-error' : '' }}">
						<label for="sheetSize" class="col-sm-4">{{ t("Select the number of labels per sheet.") }}</label>
						<div class="col-sm-6">
						<div class="form-check-inline">
						  <label class="form-check-label">
						    <input type="radio" class="form-check-input" value="21" name="label_number" selected>{{ t("21 Labels") }}
						  </label>
						</div>
						<div class="form-check-inline">
						  <label class="form-check-label">
						    <input type="radio" class="form-check-input" value="14" name="label_number">{{ t("14 Labels") }}
						  </label>
						</div>
                        <span class="text-danger">{{ $errors->first('label_number') }}</span>

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
<script type="text/javascript">

	function standardCode() {
  		var qrChar = document.getElementById("qrChar").value;
  		qrChar = qrChar.toUpperCase();
		document.getElementById("qrChar").value=qrChar;
	}
</script>