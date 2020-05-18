<div class="container p-4">
    <form method="post" action="{{ route('projects.update', $project) }}" id="group_details">
        @csrf
        @method('put')
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <h4>Edit Project Details</h4>
        <div class="form-group row required">
            <label for="name" class="col-md-4 col-form-label text-md-right">
                Project Name
            </label>
            <div class="col-md-8">
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $project->name ?: old('name') }}" required>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row required">
            <label for="description" class="col-md-4 col-form-label text-md-right">
                Brief Description
            </label>
            <div class="col-md-8">
                <textarea id="description" rows=5 name="description" class="form-control @error('description') is-invalid @enderror" required>{{ $project->description ?: old('description') }}</textarea>

                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="avatar" class="col-md-4 col-form-label text-md-right">
                Replace the project image
            </label>
            <div class="col-md-6">
                <input type="file" id="avatar" class="form-control-file @error('avatar') is-invalid @enderror" name="avatar" onchange="preview_image(event)">

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

        <hr />
        <h4>Project Privacy Settings</h4>
        <p>As part of this platform, we would like to be able to use aggregated summaries to support broader research into soil quality in smallholder farms across the CCRP network and beyond. If you would like your project's data to contribute to this aggregation, please tick the box below.</p>
        <p>The data will be suitably anonymised before sharing. Any instances where individual data points might be recognisable will be discussed with the project before being shared publically.</p>

        <div class="form-group row">
            <h5 class="col-md-4 col-form-label text-md-right">
                Data Sharing
            </h5>
            <div class="col-md-8">
                <div class="form-check mb-3">
                    <input class="form-check-input @error('share_data') is-invalid @enderror" type="radio" name="share_data" value="1" id="share_data_1">
                    <label class="form-check-label" for="share_data_1">
                        I agree to have this project's data to be included in anonymous summaries produced by the CCRP Soils Cross-cutting Project.
                    </label>

                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input @error('share_data') is-invalid @enderror" type="radio" name="share_data" value="0" id="share_summary_0" checked>
                    <label class="form-check-label" for="share_summary_0">
                        Do not include this project's data in summaries produced by the platform for use outside of this project's team.
                    </label>

                    @error('share_summary')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-10 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
            </div>
        </div>
    </form>

    <hr />
    <!-- <div class="mt-3 border border-danger p-4">
        <h4>Delete Project</h4>
        <form action="{{ route('projects.destroy', $project) }}" method="post">
            @csrf
            @method('delete')
            <div class="col-sm-8">
                <p>{{ t("You are about to delete this project.") }}</p>
                <ul style="list-style-type: circle;">
                    <li>{{ t("You will no longer be able to access the data of this project") }}</li>
                    <li>{{ t("You will no longer be able to access the forms for this project") }}</li>
                </ul>
            </div>


            <div class="col-sm mt-5">
                <button id='delete_project' class="btn btn-dark btn-sm mt-5" name="update_members">{{ t("DELETE PROJECT") }}</button>
            </div>
        </form>
    </div> -->
</div>