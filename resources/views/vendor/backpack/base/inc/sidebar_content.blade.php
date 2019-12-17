<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('dashboard') }}"><i class="nav-icon fa fa-dashboard"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('user') }}"><i class='nav-icon fa fa-drivers-license-o'></i> Users</a></li>
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('xlsform') }}"><i class='nav-icon fa fa-list-alt'></i> Xlsforms</a></li>
<li class='nav-item nav-dropdown'>

<h5 style="color: lightgrey; padding: 5px">Project Management</h5>
	<li class='nav-item'><a class='nav-link' href="{{ backpack_url('project') }}"><i class='nav-icon fa fa-file-text-o'></i> Projects</a></li>
	<li class='nav-item'><a class='nav-link' href="{{ backpack_url('projectxlsform') }}"><i class='nav-icon fa fa-clipboard'></i> Projects Xlsforms</a></li>
	<li class='nav-item'><a class='nav-link' href="{{ backpack_url('projectMember') }}"><i class='nav-icon fa fa-object-group'></i> Projects Members</a></li>

