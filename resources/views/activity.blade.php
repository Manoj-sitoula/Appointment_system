@extends('shared.header')
@section('content')
	
<nav class="breadcrumb">
    <span class="breadcrumb-item" >Dashboard</span>
    <span class="breadcrumb-item" >Activities</span>
</nav>

@if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif

<table class="table">
    <thead>
        <tr>
            <th colspan="8">
                    <div class="row">
                        <div class="col-12">
                            <form action="" >
                                @csrf
                                <input type="hidden" name="filter_key" id="filter_key" value="officer">
                                <input class="form-control" type="text" name="search" id="search" autocomplete="off" placeholder="Search">
                            </form>
                            <div  id="searchdate" style="display: none;">
                                <form action="">
                                    @csrf
                                    <input type="hidden" name="filter_date" id="filter_date" value="date" >
                                    <div class="row">
                                        <div class="col-5 form-group">
                                            <label for="first_date">First Date</label>
                                            <input class="form-control " type="date" name="first_date" id="first_date" value="2020-01-01" autocomplete="off">
                                        </div>
                                        <div class="col-5 form-group">
                                            <label for="last_date">Last Date</label>
                                            <input class="form-control " type="date" name="last_date" id="last_date" value="2020-01-01" autocomplete="off">
                                        </div>
                                        <div class="col-2 m-auto">
                                            <button type="button" class="btn btn-info" id="searchdatebtn" value="officer">Search</button>
                                        </div>
                                    </div>
                                </form> 
                            </div>
                            <div id="time" style="display: none;">
                                <form action="">
                                    @csrf 
                                    <input type="hidden" name="filter_time" id="filter_time" value="time">
                                    <div class="row" >
                                        <div class="col-5 form-group">
                                            <label for="work_start_time">Start Time:<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" placeholder="Start Time" name="first_time" id="first_time" class="form-control datetimepicker-input" data-toggle="datetimepicker"  required onkeydown="return false" onpaste="return false;" ondrop="return false;" autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="col-5 form-group">
                                            <label for="work_end_time">End Time:<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" placeholder="End Time" name="second_time" id="second_time" class="form-control datetimepicker-input" data-toggle="datetimepicker" required onkeydown="return false" onpaste="return false;" ondrop="return false;" autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="col-2 m-auto">
                                            <button type="button" class="btn btn-info" id="searchtimebtn" value="officer">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </th>
            <th colspan="1">
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addActivity">
                  <i class="fas fa-plus"></i>
                </button>
            </th>
            <th colspan="1">
                  <select class="form-control" name="filter" id="filter">
                    <option value="officer" selected>Officer</option>
                    <option value="visitor">Visitor</option>
                    <option value="type">Type</option>
                    <option value="status">Status</option>
                    <option value="date">Date</option>
                    <option value="time">Time</option>
                  </select>
            </th>
        </tr>
        <tr>
          <th scope="col">S.N.</th>
          <th scope="col">Officer Name</th>
          <th scope="col">Visitor Name</th>
          <th scope="col">Name</th>
          <th scope="col">Type</th>
          <th scope="col">Status</th>
          <th scope="col">Date</th>
          <th scope="col">Start Time</th>
          <th scope="col">End Time</th>
          <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody id="activity_table">
        <?php $count = 1; ?>
        @foreach ( $value['a'] as $data)
        <tr>
            <td>{{$count}}</td>
            <td>{{$data->officer_first_name}} {{$data->officer_last_name}}</td>
            <td>{{$data->visitor_first_name}} {{$data->visitor_last_name}}</td>
            <td>{{$data->name}}</td>
            @if ($data->type == 'Appointment')
                <td>
                    <button class="btn btn-primary btn-sm">Appointment</button>
                </td>
            @elseif ($data->type == 'Leave')
                <td>
                    <button class="btn btn-danger btn-sm">Leave</button>
                </td>
            @elseif($data->type == 'Break')
                <td>
                    <button class="btn btn-warning btn-sm">Break</button>
                </td>
            @endif 
            @if ($data->status == 'active')
                <td>
                    <form action="{{route('updateActivityStatus')}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="PUT">
                        <input type="hidden" name="officer_id" id="officer_id" value="{{$data->officer_id}}">
                        <input type="hidden" name="visitor_id" id="visitor_id" value="{{$data->visitor_id}}">
                        <input type="hidden" name="activity_id" id="activity_id" value="{{$data->activity_id}}">
                        <input type="hidden" name="status_value" id="status_value" value="{{$data->status}}">
                        <button class="btn btn-sm btn-success">Active</button>
                    </form>
                </td>
                    
            @elseif($data->status == 'inactive')
                <td>
                    <form action="{{route('updateActivityStatus')}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="PUT">
                        <input type="hidden" name="officer_id" id="officer_id" value="{{$data->officer_id}}">
                        <input type="hidden" name="visitor_id" id="visitor_id" value="{{$data->visitor_id}}">
                        <input type="hidden" name="activity_id" id="activity_id" value="{{$data->activity_id}}">
                        <input type="hidden" name="status_value" id="status_value" value="{{$data->status}}">
                    <button class="btn btn-sm btn-danger">InActive</button>
                    </form>
                </td>
            @else
                <td>
                    <button class="btn btn-sm btn-warning">Cancelled</button>
                </td>
            @endif
            <td>{{$data->date}}</td>
            <td>{{$data->start_time}}</td>
            <td>{{$data->end_time}}</td>
            <td>
                <div class="row">
                    <div class="col-lg-4 col-xl-5 col-md-12 col-sm-12 col">
                        <button type="button" class="btn btn-info btn-sm" id="updatebutton" data-bs-toggle="modal" data-bs-target="#updateActivity" value="{{$data->activity_id}}">Update</button>
                    </div>
                    <div class="col-lg-5 col-xl-5 col-md-12 col-sm-12">
                        <form action="{{route('cancelActivity')}}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input name="_method" type="hidden" value="PUT">
                            <button class="btn btn-sm btn-danger" name="activity_id"  value="{{$data->activity_id}}">Cancel</button>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
        <?php $count++ ?>
        @endforeach
    </tbody>
</table>

{{-- Start Insert Modal --}}

<div class="modal fade" id="addActivity" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addActivityLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title mx-auto  " id="addActivityLabel">Add Activity</h5>
          <button type="button" class="btn" data-bs-dismiss="modal"><i class="fas fa-x"></i></button>
        </div>
        <div class="modal-body">
            <form action="{{route('insertActivity')}}" method="POST">
                @csrf
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="officer_first_name">Officer Name<span class="text-danger">*</span></label>
                                <select class="chosen form-select" searchable="Search here.." name="officer_id">
                                    <option  disabled selected>Select Officer</option>
                                    @foreach ( $value['b'] as $res)
                                        @if ($res->officer_status == 'inactive')
                                        {
                                        }@else
                                        {       
                                            <option value="{{$res->id}}">{{$res->officer_first_name}} {{$res->officer_last_name}}</option>
                                        }
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="officer_first_name">Visitor Name<span class="text-danger">*</span></label>
                                <select class=" chosen form-select" searchable="Search here.." name="visitor_id" value="null">
                                    <option value="" selected>Select Visitor</option>
                                    @foreach ( $value['c'] as $res)
                                    @if ($res->visitor_status == 'inactive')
                                        {
                                        }@else
                                        { 
                                            <option value="{{$res->id}}">{{$res->visitor_first_name}} {{$res->visitor_last_name}}</option>
                                        }
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="officer_first_name">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control col" placeholder="Name" required="" id="name" name="name" maxlength="30" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="type">Type:<span class="text-danger">*</span></label>
                                <select class="form-control" name="type" id="type">
                                  <option>Appointment</option>
                                  <option>Leave</option>
                                  <option>Break</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="status">Status:<span class="text-danger">*</span></label><br>
                                <div class="row ">
                                    <div class="col-5 d-flex">
                                        <input class="form-check-input mx-2" type="radio" name="status" id="status" value="active" checked>
                                        <label class="form-check-label pt-1 " for="status">
                                            Active
                                        </label>
                                    </div>
                                    <div class="col-6 d-flex">
                                        <input class="form-check-input mx-2" type="radio" name="status" id="status" value="inactive" >
                                        <label class="form-check-label pt-1" for="status">
                                            UnActive
                                        </label>  
                                    </div>  
                                </div>
                            </div>
                        </div> 
                        <div class="col">
                            <div class="form-group">
                                <label for="officer_last_name">Date<span class="text-danger">*</span></label>
                                <input type="date" class="form-control col"  required="" id="date" name="date"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="work_start_time">Start Time:<span class="text-danger">*</span></label>
                                <div class="input-group">
                                      <input type="text" placeholder="Start Time" name="start_time" id="start_time" class="form-control datetimepicker-input" data-toggle="datetimepicker"  required onkeydown="return false" onpaste="return false;" ondrop="return false;" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="work_end_time">End Time:<span class="text-danger">*</span></label>
                                <div class="input-group">
                                      <input type="text" placeholder="End Time" name="end_time" id="end_time" class="form-control datetimepicker-input" data-toggle="datetimepicker" required onkeydown="return false" onpaste="return false;" ondrop="return false;" autocomplete="off" />
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="row my-2">
                        <div class="col mb-3 text-center">
                            <button class="btn btn-info" id="register" type="submit">Add</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
{{-- End Insert Modal  --}}

{{-- Start Update Modal --}}
<div class="modal fade" id="updateActivity" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateActivityLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title mx-auto  " id="updateActivityLabel">Update Activity</h5>
          <button type="button" class="btn" data-bs-dismiss="modal"><i class="fas fa-x"></i></button>
        </div>
        <div class="modal-body">
            <form action="{{route('updateActivity')}}" method="POST">
                @csrf
                @method('put')

                <input type="hidden" name="newactivity_id" id="newactivity_id" value="">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="officer_first_name">Officer Name<span class="text-danger">*</span></label>
                                <select class=" form-select" searchable="Search here.." name="newofficer_id" id="newofficer_name"> 
                                    <option value="" disabled  selected>Select Officer</option>
                                    @foreach ( $value['b'] as $res)
                                        @if ($res->officer_status == 'inactive')
                                        {
                                        }@else
                                        {       
                                            <option value="{{$res->id}}">{{$res->officer_first_name}} {{$res->officer_last_name}}</option>
                                        }
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="officer_first_name">Visitor Name<span class="text-danger">*</span></label>
                                <select class="  form-select" searchable="Search here.." name="newvisitor_id" id="newvisitor_name">
                                    <option value="" disabled selected>Select Visitor</option>
                                    @foreach ( $value['c'] as $res)
                                    @if ($res->visitor_status == 'inactive')
                                        {
                                        }@else
                                        { 
                                            <option value="{{$res->id}}">{{$res->visitor_first_name}} {{$res->visitor_last_name}}</option>
                                        }
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="officer_first_name">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control col" placeholder="Name" required="" id="newname" name="newname" maxlength="30" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="officer_last_name">Date<span class="text-danger">*</span></label>
                                <input type="date" class="form-control col"  required="" id="newdate" name="newdate"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="work_start_time">Start Time:<span class="text-danger">*</span></label>
                                <div class="input-group">
                                      <input type="text" placeholder="Start Time" name="newstart_time" id="newstart_time" class="form-control datetimepicker-input" data-toggle="datetimepicker"  required onkeydown="return false" onpaste="return false;" ondrop="return false;" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="work_end_time">End Time:<span class="text-danger">*</span></label>
                                <div class="input-group">
                                      <input type="text" placeholder="End Time" name="newend_time" id="newend_time" class="form-control datetimepicker-input" data-toggle="datetimepicker" required onkeydown="return false" onpaste="return false;" ondrop="return false;" autocomplete="off" />
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="row my-2">
                        <div class="col mb-3 text-center">
                            <button class="btn btn-info" id="newupdate" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>

{{-- End Update Modal --}}

<link rel="stylesheet" href="{{asset('assets/css/tempusdominus-bootstrap-4.min.css')}}">
<script src="{{asset('assets/js/moment.min.js')}}"></script>
<script src="{{asset('assets/js/tempusdominus-bootstrap-4.min.js')}}" ></script>
<script src="{{asset('assets/js/custom_js/customActivities.js')}}"></script>
@endsection