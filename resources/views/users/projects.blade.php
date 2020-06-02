<div class="pt-4">
    <h2>Projects</h2>

    @if($user->projects)
        <div class="card mt-4">
            <ul class="list-group list-group-flush mb-0">
                @foreach($user->projects as $project)
                    <a href="{{ route('projects.show', $project) }}">
                        <li class="list-group-item img_group_small my-2 align-items-center d-flex flex-row">
                            <img class="mr-4 img-fluid rounded" src="{{ url($project->avatar) }}" alt="{{ $project->name }} avatar" width="65px"></img>
                            <div class="media-body ml-4 ">
                                <h5>{{ $project->name }}</h5>
                                <p>{{ $project->description }}</p>
                            </div>
                        </li>
                    </a>
                @endforeach
            </ul>
        </div>
    @else
        @can('update', $user)
            <div class="alert alert-info">
                It looks like you are not a member of any projects. To use the platform, you can either:
                <ul>
                    <li>
                        <a href="{{ route('projects.index') }}">Check if your CCRP Project is already on the platform</a>
                    </li>
                    <li>
                        <a href="{{ route('projects.create') }}">Create a new project</a>
                    </li>
                </ul>
            </div>
        @else
            <p>User is not a member of any projects</p>
        @endif
    @endif
</div>
