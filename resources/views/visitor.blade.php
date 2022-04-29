
@extends('shared.header')
@section('content')

<nav class="breadcrumb">
    <span class="breadcrumb-item" >Dashboard</span>
    <span class="breadcrumb-item" >Visitor</span>
</nav>
@if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @endif
    <button type="button" class="btn btn-info float-end" data-bs-toggle="modal" data-bs-target="#addVisitor">
        <i class="fas fa-plus"></i>
      </button>
<table class="table" id="myTable">
    <thead>
        <tr>
            <th scope="col">Visitor Id</th>
            <th scope="col">Name</th>
            <th scope="col">Contact</th>
            <th scope="col">Email</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $count = 1; ?>
        @foreach ( $value as $data)
        <tr>
            <td>{{$count}}</td>
            <td>{{$data->visitor_first_name}} {{$data->visitor_last_name}}</td>
            <td>{{$data->mobile_number}}</td>
            <td>{{$data->email}}</td>
            @if ($data->status == 'active')
                <td>
                    <form action="{{route('updateVisitorStatus')}}" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" name="status_value" id="status_value" value="{{$data->status}}">
                        <button class="btn btn-sm btn-success" name="user_id" value="{{$data->id}}">Active</button>
                    </form>
                </td>
            @elseif($data->status == 'inactive')
                <td>
                    <form action="{{route('updateVisitorStatus')}}" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" name="status_value" id="status_value" value="{{$data->status}}">
                        <button class="btn btn-sm btn-danger" name="user_id" value="{{$data->id}}">InActive</button>
                    </form>
                </td>
            @endif
            <td>
                <div class="row">
                    <div class="col col-sm-12 col-md-12 col-xl-6 col-lg-6">
                        <button type="button" class="btn btn-info" id="updatebtn" data-bs-toggle="modal" data-bs-target="#updateVisitor" value="{{$data->id}}">Update</button>
                    </div>
                    <div class="col col-sm-12 col-md-12 col-xl-6 col-lg-6">
                        <button type="button" class="btn btn-info" id="visitorAppointmentbtn" value="{{$data->id}}">Appointment</button>
                    </div>
                </div>
            </td>
        </tr>
        <?php $count++ ?>
        @endforeach
    </tbody>  
</table>

<!--Insert Modal -->
<div class="modal fade" id="addVisitor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addVisitorLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title mx-auto  " id="addVisitorLabel">Add Visitor</h5>
          <button type="button" class="btn" data-bs-dismiss="modal"><i class="fas fa-x"></i></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{route('insertVisitor')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body p-0">
                      <div class="row">
                          <div class="col">
                              <div class="form-group">
                                  <label for="full name">First Name<span class="text-danger">*</span></label>
                                  <input type="text" class="form-control col" placeholder="First name" required="" id="visitor_first_name" name="visitor_first_name" maxlength="30" autocomplete="off" />
                                  <div class="invalid-feedback">Please enter first name.</div>
                              </div>
                          </div>
                          <div class="col">
                              <div class="form-group">
                                  <label for="full name">Last Name<span class="text-danger">*</span></label>
                                  <input type="text" class="form-control col" placeholder=" Last name" required="" id="visitor_last_name" name="visitor_last_name" maxlength="30" autocomplete="off" />
                                  <div class="invalid-feedback">Please enter last name.</div>
                              </div>
                          </div>
                      </div>
                          <div class="col">
                              <div class="form-group">
                                  <label for="phone">Phone No:<span class="text-danger">*</span></label>
                                  <div class="input-group">
                                        <input type="text" placeholder="Phone No" name="phone_no" id="phone_no" class="form-control" required autocomplete="off" />
                                  </div>
                              </div>
                          </div>
                          <div class="col">
                              <div class="form-group">
                                  <label for="phone">Email:<span class="text-danger">*</span></label>
                                  <div class="input-group">
                                        <input type="text" placeholder="Email" name="email" id="email" class="form-control" required autocomplete="off" />
                                  </div>
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
                      
                      <div class="row my-2 mt-2">
                          <div class="col mb-3 text-center">
                              <button class="btn btn-info" id="register" type="submit" >Insert</button>
                          </div>
                      </div>
                  </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- End Insert Modal --}}

  {{-- Start  Update Model --}}

  <div class="modal fade" id="updateVisitor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateVisitorLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title mx-auto  " id="updateVisitorLabel">Update Visitor</h5>
          <button type="button" class="btn" data-bs-dismiss="modal"><i class="fas fa-x"></i></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{route('updateVisitor')}}" enctype="multipart/form-data">
                  @csrf
                  @method('put')

                  <input type="hidden" name="visitor_id" id="visitor_id">
                  <div class="card-body p-0">
                      <div class="row">
                          <div class="col">
                              <div class="form-group">
                                  <label for="full name">First Name<span class="text-danger">*</span></label>
                                  <input type="text" class="form-control col" placeholder="First name" required="" id="new_visitor_first_name" name="new_visitor_first_name" maxlength="30" autocomplete="off" />
                                  <div class="invalid-feedback">Please enter first name.</div>
                              </div>
                          </div>
                          <div class="col">
                              <div class="form-group">
                                  <label for="full name">Last Name<span class="text-danger">*</span></label>
                                  <input type="text" class="form-control col" placeholder=" Last name" required="" id="new_visitor_last_name" name="new_visitor_last_name" maxlength="30" autocomplete="off" />
                                  <div class="invalid-feedback">Please enter last name.</div>
                              </div>
                          </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                            <label for="phone">Phone No:<span class="text-danger">*</span></label>
                            <div class="input-group">
                                  <input type="text" placeholder="Phone No" name="new_phone_no" id="new_phone_no" class="form-control" required autocomplete="off" />
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="phone">Email:<span class="text-danger">*</span></label>
                            <div class="input-group">
                                  <input type="text" placeholder="Email" name="new_email" id="new_email" class="form-control" required autocomplete="off" />
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

  {{-- End Update Model --}}

  {{-- AppointmentModal --}}
<div class="modal fade" id="visitorAppointment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="visitorAppointmentLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title mx-auto  " id="visitorAppointmenttLabel">Appointments </h5>
          <button type="button" class="btn" data-bs-dismiss="modal"><i class="fas fa-x"></i></button>
        </div>
        <div class="modal-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Officer Name</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="visitorAppointmentTbl">

                </tbody>
                
            </table>
        </div>
      </div>
    </div>
</div>
{{-- End Appointment Modal --}}
  <script src="{{asset('assets/js/custom_js/customVisitor.js')}}"></script>

@endsection