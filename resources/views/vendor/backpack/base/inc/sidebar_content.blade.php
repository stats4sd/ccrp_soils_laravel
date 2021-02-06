<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class='nav-item'><a class='nav-link' href="{{ route('home') }}"><i class="nav-icon fa fa-home"></i>Back to Front End</a></li>

<li class='nav-item'><a class='nav-link' href="{{ backpack_url('dashboard') }}"><i class="nav-icon fa fa-dashboard"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item"><a href="{{ backpack_url('sample') }}" class="nav-link"><i class="nav-icon fa fa-data"></i> Soil Samples</a></li>

@if(auth()->user()->isAdmin())
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('user') }}"><i class='nav-icon fas fa-user'></i> Users</a></li>
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('xlsform') }}"><i class='nav-icon fa fa-list-alt'></i> Xlsforms</a></li>
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('project') }}"><i class='nav-icon fa fa-file-text-o'></i> Projects</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('datamap') }}'><i class='nav-icon la la-question'></i> DataMaps</a></li>
@endif

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('projectsubmission') }}'><i class='nav-icon la la-question'></i> ProjectSubmissions</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('nutrientbalance') }}'><i class='nav-icon la la-question'></i> NutrientBalances</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('farmerfield') }}'><i class='nav-icon la la-question'></i> FarmerFields</a></li>