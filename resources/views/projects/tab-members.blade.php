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
                    <td>Admin</td>
                    @can('update', $project)
                        <td>
                            <button class="btn btn-dark btn-sm" name="edit_member{{ $user->id }}" onclick="">{{ t("EDIT") }}</button>
                            <button class="btn btn-dark btn-sm" name="delete_member{{ $user->id }}">{{ t("DELETE") }}</button>
                        </td>
                    @endcan
                </tr>
                @endforeach

        </tbody>
    </table>
</div>
<button class="btn btn-dark btn-sm mt-5" name="update_members">{{ t("INVITE MEMBERS") }}</button>