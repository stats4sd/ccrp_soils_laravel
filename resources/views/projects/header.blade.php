<h1 class="mb-5"><b>{{$project->name}}</b></h1>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3">
            <div class="img_group_default">
                <img src="{{ Storage::url($project->avatar) }}" id="img_group">
            </div>
        </div>
        <div class="col-sm-5">
            <br>
            <div id="description">
                <p>{{ $project->description }}</p>
            </div>
        </div>
        <div class="col-sm-4 border border-right-0 border-bottom-0 border-top-0">
            <div class="admin_group">
                <h3 class="pb-2"><b>{{ t("Admins") }}</b></h3>
                @foreach ($project->admins as $admin)
                <a href="{{ route('users.show', $admin->slug )}}" data-toggle="tooltip" title="{{ $admin->username }}" class="d-flex flex-row justify-content-start align-items-center">
                    <img src="{{ url($admin->avatar) }}">
                    <h5 class="pl-3">{{ $admin->name }}</h5>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>