{{-- <div id="Invite" class="tabcontent">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <label>{{ t("Search for members to invite:") }}</label>
<form method="post" action="{{url('en/projects/'.$project->id.'/send')}}" name="invite" id="invite">
    {{ csrf_field() }}
    <input type="text" id="myInput" onkeyup="search()" class="form-control" placeholder="Search for names..">
    <div class="scroll_list">
        <div class="form-group">
            <table id="myTable" class="table table-hover">
                <tbody>
                    @foreach($users as $user)

                    <tr>
                        <td><input class="checkboxClass" type="checkbox" name="name_selected[]" id="{{$user->id}}" value="{{$user->id}}"> {{$user->name}}</td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="form-group">
        <label for="email">{{ t("Enter the email addresses of people to invite.") }}</label>
        <input style="width: 100%;" type="email" class="form-control" name="email_inserted" multiple>
    </div>

    <button type="submit" class="btn btn-dark btn-sm" id="send_email">{{ t("SUBMIT")}}</button>
</form>

</div>
<div class="col-sm-6">
    <div class="alert alert-info">
        <strong>{{ t("Select people to invite from your friends list.") }}</strong>
    </div>

</div>
</div>
</div>
</div> --}}



<div id="members">
    @foreach($project->users as $member)

    <div class="card mb-3" style="max-width: 350px;">
        <div class="row no-gutters">
            <div class="col-md-4 img_group mb-3 mt-3">
                <a href={{url(app()->getLocale().'/users/'.$member->slug)}}><img src="{{$member->avatar}}" class="center" alt="Person"></a>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <a href={{url(app()->getLocale().'/users/'.$member->slug)}}>
                        <h5 class="card-title"><b>{{$member->username}}</b></h5>
                    </a>
                    <p class="card-text"><small class="text-muted"><b>{{ t("created at :") }}</b> {{$member->created_at->diffForHumans()}}</small></p>
                </div>
            </div>
        </div>
    </div>

    @endforeach
</div>

<div class="container">
    <div class="img_group mt-3">
        <b>{{ t("Members") }}</b>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">{{ t("Avatar") }}</th>
                    <th scope="col">{{ t("Username") }}</th>
                    <th scope="col">{{ t("Status") }}</th>
                    <th scope="col">{{ t("Actions") }}</th>
                </tr>
            </thead>
            <tbody>

                <form method="post" action="" id="change_details">

                    @csrf

                    @foreach($project->users as $member)

                    <tr>
                        <td>
                            <div class="img_group mb-3">
                                <a href="members/{{$member->username}}">
                                    <img src="{{$member->avatar}}" alt="Person">
                                </a>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">

                                <div id="change_id{{$member->id}}" value="{{$member->id}}">
                                    <a href="members/{{$member->username}}">
                                        <p>{{$member->username}}</p>
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div id="member_status{{$member->id}}">
                                @if($member->pivot->is_admin)
                                <p>{{ t("Admin") }}</p>
                                @else
                                <p>{{ t("User") }}</p>
                                @endif
                            </div>
                            <p id="status{{$member->id}}"></p>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-dark btn-sm" name="update_members" onclick="changeStatus({{$project->id}},{{$member->id}})">{{ t("CHANGE STATUS") }}</button>
                            <button type="submit" id="delete" class="btn btn-dark btn-sm" onclick="deleteMember({{$project->id}},{{$member->id}})" name="update_members">{{ t("DELETE") }}</button>

                        </td>
                    </tr>
                    @endforeach
                </form>

            </tbody>
        </table>
    </div>
</div>
<button onclick="openPage(event, 'Members')" class="btn btn-dark btn-sm mt-5" name="update_members">{{ t("INVITE MEMBERS") }}</button>