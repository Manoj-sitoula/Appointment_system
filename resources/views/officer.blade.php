@extends('shared.header')
@section('content')

<nav class="breadcrumb">
    <span class="breadcrumb-item" >Dashboard</span>
    <span class="breadcrumb-item" >Officer</span>
</nav>

@if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @endif
 
<table class="table">
    <thead>
        <tr>
            <th colspan="6">
            </th>
            <th colspan="1">
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addOfficer">
                  Add New
                </button>
            </th>
        </tr>
        <tr>
          <th scope="col">Officer Id</th>
          <th scope="col">Name</th>
          <th scope="col">Post</th>
          <th scope="col">Status</th>
          <th scope="col">Work Start Time</th>
          <th scope="col">Work End Time</th>
          <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $value as $data)
        <tr>
            <td>{{$data->id}}</td>
            <td>{{$data->officer_first_name}} {{$data->officer_last_name}}</td>
            <td>{{$data->officer_post}}</td>
            @if ($data->officer_status == 'active')
                <td>
                    <form action="{{route('updateOfficerStatus')}}" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" name="user_id" id="user_id" value="{{$data->id}}">
                        <input type="hidden" name="status_value" id="status_value" value="{{$data->officer_status}}">
                        <button class="btn btn-sm btn-success">Active</button>
                    </td>
                    </form>
                    
            @elseif($data->officer_status == 'inactive')
                <td>
                    <form action="{{route('updateOfficerStatus')}}" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" name="user_id" id="user_id" value="{{$data->id}}">
                        <input type="hidden" name="status_value" id="status_value" value="{{$data->officer_status}}">
                    <button class="btn btn-sm btn-danger">InActive</button>
                    </form>
                    
                </td>
            @endif
            <td>{{$data->work_start_time}}</td>
            <td>{{$data->work_end_time}}</td>
            <td>
                <div class="row">
                    <div class="col-lg-4 col-xl-6 col-md-12 col-sm-12 col">
                        <button type="button" class="btn btn-info" id="updatebtn" data-bs-toggle="modal" data-bs-target="#updateOfficer" value="{{$data->id}}">Update</button>
                    </div>
                    <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                        <button class="btn btn-info">Appointment</button>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    
</table>


<!--Insert Modal -->
<div class="modal fade" id="addOfficer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addOfficerLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mx-auto  " id="addOfficerLabel">Add Officer</h5>
        <button type="button" class="btn" data-bs-dismiss="modal"><i class="fas fa-x"></i></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('insertOfficer')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="full name">First Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control col" placeholder="First name" required="" id="officer_first_name" name="officer_first_name" maxlength="30" autocomplete="off" />
                                <div class="invalid-feedback">Please enter first name.</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="full name">Last Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control col" placeholder=" Last name" required="" id="officer_last_name" name="officer_last_name" maxlength="30" autocomplete="off" />
                                <div class="invalid-feedback">Please enter last name.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="officerPost">Post:<span class="text-danger">*</span></label>
                                <select class="form-control" name="post" id="post">
                                  <option>CEO</option>
                                  <option>Manager</option>
                                  <option>Senior Developer</option>
                                </select>
                            </div>
                        </div>
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
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="phone">Work Start Time:<span class="text-danger">*</span></label>
                                <div class="input-group">
                                      <input type="text" placeholder="Work Start Time" name="work_start_time" id="work_start_time" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#doctor_schedule_start_time" required onkeydown="return false" onpaste="return false;" ondrop="return false;" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="phone">Work End Time:<span class="text-danger">*</span></label>
                                <div class="input-group">
                                      <input type="text" placeholder="Work End Time" name="work_end_time" id="work_end_time" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#doctor_schedule_start_time" required onkeydown="return false" onpaste="return false;" ondrop="return false;" autocomplete="off" />
                                </div>
                            </div>
                        </div> 
                    </div>
                    
                    <div class="row my-2">
                        <div class="col mb-3 text-center">
                            <button class="btn btn-info" id="register" type="submit" disabled="disabled">Insert</button>
                        </div>
                    </div>
                </div>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- End Insert Modal --}}

{{-- Update Modal --}}

<div class="modal fade" id="updateOfficer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateOfficerLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title mx-auto  " id="updateOfficerLabel">Update Officer</h5>
          <button type="button" class="btn" data-bs-dismiss="modal"><i class="fas fa-x"></i></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{route('updateOfficer')}}" enctype="multipart/form-data">
                  @csrf
                  @method('put')

                  <input type="hidden" name="officer_id" id="officer_id">
                  <div class="card-body p-0">
                      <div class="row">
                          <div class="col">
                              <div class="form-group">
                                  <label for="full name">First Name<span class="text-danger">*</span></label>
                                  <input type="text" class="form-control col" placeholder="First name" required="" id="new_officer_first_name" name="new_officer_first_name" maxlength="30" autocomplete="off" />
                                  <div class="invalid-feedback">Please enter first name.</div>
                              </div>
                          </div>
                          <div class="col">
                              <div class="form-group">
                                  <label for="full name">Last Name<span class="text-danger">*</span></label>
                                  <input type="text" class="form-control col" placeholder=" Last name" required="" id="new_officer_last_name" name="new_officer_last_name" maxlength="30" autocomplete="off" />
                                  <div class="invalid-feedback">Please enter last name.</div>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <div class="form-group">
                                  <label for="officerPost">Post:<span class="text-danger">*</span></label>
                                  <select class="form-control" name="new_post" id="new_post">
                                    <option>CEO</option>
                                    <option>Manager</option>
                                    <option>Senior Developer</option>
                                  </select>
                              </div>
                          </div>
                      </div>
                      
                      <div class="row">
                          <div class="col">
                              <div class="form-group">
                                  <label for="phone">Work Start Time:<span class="text-danger">*</span></label>
                                  <div class="input-group">
                                        <input type="text" name="new_work_start_time" id="new_work_start_time" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#doctor_schedule_start_time" placeholder="Work Start Time" required onkeydown="return false" onpaste="return false;" ondrop="return false;" autocomplete="off" />
                                  </div>
                              </div>
                          </div>
                          <div class="col">
                              <div class="form-group">
                                  <label for="phone">Work End Time:<span class="text-danger">*</span></label>
                                  <div class="input-group">
                                        <input type="text" name="new_work_end_time" id="new_work_end_time" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#doctor_schedule_start_time" placeholder="Work End Time" required onkeydown="return false" onpaste="return false;" ondrop="return false;" autocomplete="off" />
                                  </div>
                              </div>
                          </div> 
                      </div>
                      
                      <div class="row my-2">
                          <div class="col mb-3 text-center">
                              <button class="btn btn-info" id="register" type="submit">Update</button>
                          </div>
                      </div>
                  </div>
          </form>
        </div>
      </div>
    </div>
  </div>

{{-- End Update Modal --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css"/>
<script src="{{asset('assets/js/custom_js/customOfficer.js')}}"></script>
@endsection