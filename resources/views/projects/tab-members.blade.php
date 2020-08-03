<div class="container mt-4">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">{{ t("Avatar") }}</th>
                <th scope="col">{{ t("Name") }}</th>
                <th scope="col">{{ t("Email") }}</th>
                <th scope="col">{{ t("Kobotoolbox Account") }}</th>
                <th scope="col">{{ t("Access Type") }}</th>
                @can('update', $project)
                    <th scope="col">{{ t("Actions") }}</th>
                @endcan
            </tr>
        </thead>
        <tbody>
                @foreach($project->users as $user)
                <tr>
                    <td>
                        <a href="{{ route('users.show', $user) }}" class="admin_group">
                            <img src="{{ url($user->avatar) }}" alt="{{ $user->name }} avatar" class="img-fluid">
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('users.show', $user) }}">
                            {{ $user->name }}
                        </a>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->kobo_id }}</td>
                    <td>{{  $user->pivot->admin ? 'Admin' : 'Member' }}</td>
                    @can('update', $project)
                        <td>
                            <a href="{{ route('projectmembers.edit', [$project, $user]) }}" class="btn btn-dark btn-sm" name="edit_member{{ $user->id }}" onclick="">{{ t("EDIT") }}</a>
                            <button class="btn btn-dark btn-sm remove-button" data-user="{{ $user->id }}" data-toggle="modal" data-target="#removeUserModal{{ $user->id }}">{{ t("REMOVE") }}</button>
                        </td>
                    @endcan
                </tr>
                @endforeach

        </tbody>
    </table>
    <hr/>
    <h4>Pending Invites</h4>
    <ul class="list-group">
        @foreach($project->invites as $invite)
            <li class="list-group-item list-group-flush d-flex">
                <div class="w-50">{{ $invite->email }}</div>
                <div class="w-25">Invited on {{ $invite->invite_day }}</div>
            </li>
        @endforeach
    </ul>
</div>
@can('update', $project)
    <a class="btn btn-dark btn-sm mt-5" href="{{ route('projectmembers.create', $project) }}">{{ t("INVITE MEMBERS") }}</a>
@endcan

@foreach($project->users as $user)
<div class="modal fade" id="removeUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="removeUserModalLabel{{ $user->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="removeUserModalLabel{{ $user->id }}">{{ t("Remove User from :projectName", ['projectName' => $project->name]) }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ t("Are you sure you wish to remove :userName from :projectName? After removing, they will no longer have access to any project data or forms on Kobotoolbox.", ['userName' => $user->name, 'projectName' => $project->name] ) }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ t("Cancel") }}</button>
        <form action="{{ route('projectmembers.destroy', [$project, $user]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-primary">{{ t("Confirm Remove") }}</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach

