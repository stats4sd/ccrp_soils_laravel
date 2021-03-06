
@extends('layouts.two_panel')

@section('content')

<div class="card">
    <div class="card-header">
        <b>Add New Project</b>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('projects.store')}}" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h4>{{ t("Project Details") }}</h4>
            <div class="form-group row required">
                <label for="name" class="col-md-4 col-form-label text-md-right">
                    {{ t("Project Name") }}
                </label>
                <div class="col-md-8">
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        required>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row required">
                <label for="description" class="col-md-4 col-form-label text-md-right">
                    {{ t("Brief Description") }}
                </label>
                <div class="col-md-8">
                    <textarea
                        id="description"
                        rows=5
                        name="description"
                        class="form-control @error('description') is-invalid @enderror"
                        value="{{ old('description') }}"
                        required></textarea>

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="avatar" class="col-md-4 col-form-label text-md-right">
                    {{ t("Add an image to identify the project") }}
                </label>
                <div class="col-md-6">
                    <input
                        type="file"
                        id="avatar"
                        class="form-control-file @error('avatar') is-invalid @enderror"
                        name="avatar"
                        onchange="preview_image(event)"
                    >

                    @error('avatar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-md-4 col-form-label text-md-right"></label>
                <div class="col-md-3">
                    <figure class="img_group_default">
                        <img src="{{ url('images/mystery-group.png') }}" id="avatar">
                        <figcaption class="figure-caption" id="avatar-caption"></figcaption>
                    </figure>
                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-md-4 col-form-label text-md-right">
                    {{ t("Do you need Olsen P Analysis Outputs split between LR and HR?") }}
                </h5>
                <div class="form-check mb-3">
                    <input
                        class="form-check-input @error('highR') is-invalid @enderror"
                        type="radio"
                        name="highR"
                        value="1"
                        id="highR1">
                    <label class="form-check-label" for="highR1">
                        {{ t("Yes") }}
                    </label>

                </div>

                <div class="form-check mb-3">
                    <input
                        class="form-check-input @error('highR') is-invalid @enderror"
                        type="radio"
                        name="highR"
                        value="0"
                        id="highR_1">
                    <label class="form-check-label" for="highR_1">
                        {{ t("No") }}
                    </label>

                </div>
            </div>
            <div class="form-group row">
                <h5 class="col-md-4 col-form-label text-md-right">
                    {{ t("Do you need additional Olsen P Analysis Output columns for Custom Reagent packs?") }}
                </h5>
                <div class="form-check mb-3">
                    <input
                        class="form-check-input @error('customR') is-invalid @enderror"
                        type="radio"
                        name="customR"
                        value="1"
                        id="customR1">
                    <label class="form-check-label" for="customR1">
                        {{ t("Yes") }}
                    </label>

                </div>

                <div class="form-check mb-3">
                    <input
                        class="form-check-input @error('customR') is-invalid @enderror"
                        type="radio"
                        name="customR"
                        value="0"
                        id="customR_1">
                    <label class="form-check-label" for="customR_1">
                        {{ t("No") }}
                    </label>

                </div>
            </div>

            <hr/>
            <h3>{{ t("Project Privacy Settings") }}</h3>
            <p>
                {{ t("As part of this platform, we would like to be able to use aggregated summaries to support broader research into soil quality in smallholder farms across the CCRP network and beyond. If you would like your project's data to contribute to this aggregation, please tick the box below.") }}
            </p>
            <p>
                {{ t("The data will be suitably anonymised before sharing. Any instances where individual data points might be recognisable will be discussed with the project before being shared publically.") }}
            </p>

            <div class="form-group row">
                <h5 class="col-md-4 col-form-label text-md-right">
                    {{ t("Data Sharing") }}
                </h5>
                <div class="col-md-8">
                    <div class="form-check mb-3">
                        <input
                            class="form-check-input @error('share_data') is-invalid @enderror"
                            type="radio"
                            name="share_data"
                            value="1"
                            id="share_data_1">
                        <label class="form-check-label" for="share_data_1">
                            {{ t("I agree to have this project's data to be included in anonymous summaries produced by the CCRP Soils Cross-cutting Project.") }}
                        </label>

                    </div>
                    <div class="form-check mb-3">
                        <input
                            class="form-check-input @error('share_data') is-invalid @enderror"
                            type="radio"
                            name="share_data"
                            value="0"
                            id="share_summary_0"
                            checked>
                        <label class="form-check-label" for="share_summary_0" >
                            {{ t("Do not include this project's data in summaries produced by the platform for use outside of this project's team.") }}
                        </label>

                        @error('share_summary')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
            </div>


            <h5>{{ t("Terms of Use") }}</h5>
            <div class="form-check">
                <input
                    class="form-check-input @error('share_summary') is-invalid @enderror"
                    type="checkbox"
                    name="share_summary"
                    value="1"
                    id="share_summary">
              <label class="form-check-label" for="share_summary">
                {{ t("I agree to the terms of use laid out in the site policy page") }}
              </label>

                @error('share_summary')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <input type="hidden" value="{{ auth()->user()->id }}" name="creator_id"/>
            <div class="form-group row mb-0">
                <div class="col-md-10 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
