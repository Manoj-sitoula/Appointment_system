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
<button type="button" class="btn btn-info float-end" data-bs-toggle="modal" data-bs-target="#addOfficer">
    <i class="fas fa-plus"></i>
  </button>
<table class="table" id="myTable">
    <thead>
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
        <?php $count = 1; ?>
        @foreach ( $value as $data)
        <tr>
            <td>{{$count}}</td>
            <td>{{$data->officer_first_name}} {{$data->officer_last_name}}</td>
            <td>{{$data->officer_post}}</td>
            @if ($data->officer_status == 'active')
                <td>
                    <form action="{{route('updateOfficerStatus')}}" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" name="user_id" value="{{$data->id}}">
                        <input type="hidden" name="status_value" id="status_value" value="{{$data->officer_status}}">
                        <input type="submit" class="btn btn-sm btn-success" value="Active">
                    </td>
                    </form>
                    
            @elseif($data->officer_status == 'inactive')
                <td>
                    <form action="{{route('updateOfficerStatus')}}" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" name="user_id" value="{{$data->id}}">
                        <input type="hidden" name="status_value" id="status_value" value="{{$data->officer_status}}">
                        <input type="submit" class="btn btn-sm btn-danger" value="InActive">
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
                        <button class="btn btn-info" id="appointments" value="{{$data->id}}">Appointment</button>
                    </div>
                </div>
            </td>
        </tr>
        <?php $count++ ?>
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
                                <label for="officer_first_name">First Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control col" placeholder="First name" required="" id="officer_first_name" name="officer_first_name" maxlength="30" autocomplete="off" />
                                <div class="invalid-feedback">Please enter first name.</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="officer_last_name">Last Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control col" placeholder=" Last name" required="" id="officer_last_name" name="officer_last_name" maxlength="30" autocomplete="off" />
                                <div class="invalid-feedback">Please enter last name.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="post">Post:<span class="text-danger">*</span></label>
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
                                <label for="work_start_time">Work Start Time:<span class="text-danger">*</span></label>
                                <div class="input-group">
                                      <input type="text" placeholder="Work Start Time" name="work_start_time" id="work_start_time" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#doctor_schedule_start_time" required onkeydown="return false" onpaste="return false;" ondrop="return false;" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="work_end_time">Work End Time:<span class="text-danger">*</span></label>
                                <div class="input-group">
                                      <input type="text" placeholder="Work End Time" name="work_end_time" id="work_end_time" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#doctor_schedule_start_time" required onkeydown="return false" onpaste="return false;" ondrop="return false;" autocomplete="off" />
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-check form-check-inline form-group">
                            <label for="new_work_end_time">Work Days<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="col">
                                    <input class="form-check-input" type="checkbox" name="days[]" id="sunday" value="sunday">
                                    <label class="form-check-label" for="sunday">Sun</label>
                                </div>
                                <div class="col">
                                    <input class="form-check-input" type="checkbox" name="days[]" id="monday" value="monday">
                                    <label class="form-check-label" for="monday">Mon</label>
                                </div>
                                <div class="col">
                                    <input class="form-check-input" type="checkbox" name="days[]" id="tuesday" value="tuesday">
                                    <label class="form-check-label" for="tuesday">Tue</label>
                                </div>
                                <div class="col">
                                    <input class="form-check-input" type="checkbox" name="days[]" id="wednesday" value="wednesday">
                                    <label class="form-check-label" for="wednesday">Wed</label>
                                </div>
                                <div class="col">
                                    <input class="form-check-input" type="checkbox" name="days[]" id="thursday" value="thursday">
                                    <label class="form-check-label" for="thursday">Thur</label>
                                </div>
                                <div class="col">
                                    <input class="form-check-input" type="checkbox" name="days[]" id="friday" value="friday">
                                    <label class="form-check-label" for="friday">Fri</label>
                                </div>
                                <div class="col">
                                    <input class="form-check-input" type="checkbox" name="days[]" id="saturday" value="saturday">
                                    <label class="form-check-label" for="saturday">Sat</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row my-2">
                        <div class="col mb-3 text-center">
                            <button class="btn btn-info" id="register" type="submit" disabled="disabled">Add</button>
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
                                  <label for="new_officer_first_name">First Name<span class="text-danger">*</span></label>
                                  <input type="text" class="form-control col" placeholder="First name" required="" id="new_officer_first_name" name="new_officer_first_name" maxlength="30" autocomplete="off" />
                                  <div class="invalid-feedback">Please enter first name.</div>
                              </div>
                          </div>
                          <div class="col">
                              <div class="form-group">
                                  <label for="new_officer_last_name">Last Name<span class="text-danger">*</span></label>
                                  <input type="text" class="form-control col" placeholder=" Last name" required="" id="new_officer_last_name" name="new_officer_last_name" maxlength="30" autocomplete="off" />
                                  <div class="invalid-feedback">Please enter last name.</div>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <div class="form-group">
                                  <label for="new_post">Post:<span class="text-danger">*</span></label>
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
                                  <label for="new_work_start_time">Work Start Time:<span class="text-danger">*</span></label>
                                  <div class="input-group">
                                        <input type="text" name="new_work_start_time" id="new_work_start_time" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#doctor_schedule_start_time" placeholder="Work Start Time" required onkeydown="return false" onpaste="return false;" ondrop="return false;" autocomplete="off" />
                                  </div>
                              </div>
                          </div>
                          <div class="col">
                              <div class="form-group">
                                  <label for="new_work_end_time">Work End Time:<span class="text-danger">*</span></label>
                                  <div class="input-group">
                                        <input type="text" name="new_work_end_time" id="new_work_end_time" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#doctor_schedule_start_time" placeholder="Work End Time" required onkeydown="return false" onpaste="return false;" ondrop="return false;" autocomplete="off" />
                                  </div>
                              </div>
                          </div> 
                      </div>
                      <div class="row">
                        <div class="form-check form-check-inline form-group">
                            <label for="new_work_end_time">Work Days<span class="text-danger">*</span></label>
                            <div class="input-group"> 
                                <div class="col">
                                    <input class="form-check-input" type="checkbox" name="newdays[]" id="newsunday" value="sunday">
                                    <label class="form-check-label" for="sunday">Sun</label>
                                </div>
                                <div class="col">
                                    <input class="form-check-input" type="checkbox" name="newdays[]" id="newmonday" value="monday">
                                    <label class="form-check-label" for="monday">Mon</label>
                                </div>
                                <div class="col">
                                    <input class="form-check-input" type="checkbox" name="newdays[]" id="newtuesday" value="tuesday">
                                    <label class="form-check-label" for="tuesday">Tue</label>
                                </div>
                                <div class="col">
                                    <input class="form-check-input" type="checkbox" name="newdays[]" id="newwednesday" value="wednesday">
                                    <label class="form-check-label" for="wednesday">Wed</label>
                                </div>
                                <div class="col">
                                    <input class="form-check-input" type="checkbox" name="newdays[]" id="newthursday" value="thursday">
                                    <label class="form-check-label" for="thursday">Thur</label>
                                </div>
                                <div class="col">
                                    <input class="form-check-input" type="checkbox" name="newdays[]" id="newfriday" value="friday">
                                    <label class="form-check-label" for="friday">Fri</label>
                                </div>
                                <div class="col">
                                    <input class="form-check-input" type="checkbox" name="newdays[]" id="newsaturday" value="saturday">
                                    <label class="form-check-label" for="saturday">Sat</label>
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

{{-- AppointmentModal --}}
<div class="modal fade" id="appointment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="appointmentLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title mx-auto  " id="appointmeentLabel">Appointments </h5>
          <button type="button" class="btn" data-bs-dismiss="modal"><i class="fas fa-x"></i></button>
        </div>
        <div class="modal-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Visitor Name</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="tblappointment">

                </tbody>
                
            </table>
        </div>
      </div>
    </div>
</div>
{{-- End Appointment Modal --}}
<link rel="stylesheet" href="{{asset('assets/css/tempusdominus-bootstrap-4.min.css')}}">
<script src="{{asset('assets/js/moment.min.js')}}"></script>
<script src="{{asset('assets/js/tempusdominus-bootstrap-4.min.js')}}" ></script>
<script src="{{asset('assets/js/custom_js/customOfficer.js')}}"></script>
@endsection