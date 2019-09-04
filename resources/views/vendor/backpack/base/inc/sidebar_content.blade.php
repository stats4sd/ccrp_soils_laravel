<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
<li><a href='{{ backpack_url('user') }}'><i class='fa fa-drivers-license-o'></i> <span>Users</span></a></li>
<li><a href='{{ backpack_url('xlsform') }}'><i class='fa fa-list-alt'></i> <span>Xlsforms</span></a></li>
<li class="treeview">
	<a href="#"><i class="fa fa-file-text-o"></i><span>Projects</span><i class="fa fa-angle-left pull-right"></i></a>
	<ul class="treeview-menu">
		<li><a href='{{ backpack_url('project') }}'><i class='fa fa-file-text-o'></i> <span>Projects</span></a></li>
		<li><a href='{{ backpack_url('projectxlsform') }}'><i class='fa fa-clipboard'></i> <span>Projects Xlsforms</span></a></li>
		<li><a href='{{ backpack_url('projectMember') }}'><i class='fa fa-object-group'></i> <span>Projects Members</span></a></li>
	</ul>
</li>


<!-- <li><a href="{{ backpack_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li> -->