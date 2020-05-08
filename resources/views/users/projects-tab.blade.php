<div class="pt-4">
    <h2>Projects</h2>

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
</div>