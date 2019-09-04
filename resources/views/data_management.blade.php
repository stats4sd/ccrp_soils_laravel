
@extends('layouts.layout')

@section('content')

<div class="col-sm-12">
<section class="content mb-5" id="form_data_management">
  <div class="alert alert-info">
    {{ t("To view data for a project you must first be invited to the group. Please either go to the projects page and request membership for your project, or contact rms@stats4sd.org.") }}"
  </div>

  <h2 class="mb-5"><strong>{{ t("Form and Data Management") }}</strong></h2>
    <p>{{ t("This page is where you manage the forms that are shared with you through Kobotoolbox, and review and download data collected through those forms.") }}</p>
    <p>{{ t("To collect data through this platform, please do the following:") }}</p>
  <div class="card mx-5 mt-5">
    <div class="card-header"><h3><strong>{{ t("Instructions") }}</strong></h3>

    </div>
      <div class="card-body">
        <h4><b>{{ t("1. Sync Forms to Kobotoolbox") }}</b></h4>
          <p>{{ t("The table below shows the forms available for your project. Deployed forms are shared with your Kobotoolbox account - you should be able to see them by logging into Kobotools using your project account. To deploy a form, click the button in the Status column.") }}</p>
        <h4 class="mt-5"><b>{{ t("2. Collect Data") }}</b></h4>
          <p>{{ t("With your forms deployed, you can collect data via Kobotoolbox / ODK Collect in the normal way. To pull new records from Kobotoolbox, click the button above. This will update the table with the number of records collected with each form.") }}</p>
        <h4 class="mt-5"><b>{{ t("3. Merge and download data") }}</b></h4>
          <p>{{ t("You can download data from Kobotoolbox directly, but this will give you one data file per form. Using this platform, you can get a merged dataset, containing 1 row per soil sample and data from all the forms above.") }}</p>
      </div>
    </div>

</section>
<section>
  <div class="card mx-5 mt-5">
    <div class="card-header"><h3><b>{{ t("Forms and Data") }}</b></h3></div>
      <div class="card-body">
        
      </div>
    
  </div>
</section>
</div>
@endsection

