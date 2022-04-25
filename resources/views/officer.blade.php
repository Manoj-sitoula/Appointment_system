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
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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
            <td>{{$data->officer_status}}</td>
            <td>{{$data->work_start_time}}</td>
            <td>{{$data->work_end_time}}</td>
        </tr>
        @endforeach
    </tbody>
    
</table>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mx-auto  " id="staticBackdropLabel">Add Officer</h5>
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
                                        <input class="form-check-input mx-2" type="radio" name="status" id="status" checked>
                                        <label class="form-check-label pt-1 " for="status">
                                            Active
                                        </label>
                                    </div>
                                    <div class="col-6 d-flex">
                                        <input class="form-check-input mx-2" type="radio" name="status" id="status" >
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
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-clock"></i></span>
                                    </div>
                                      <input type="text" name="work_start_time" id="work_start_time" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#doctor_schedule_start_time" required onkeydown="return false" onpaste="return false;" ondrop="return false;" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="phone">Work End Time:<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-clock"></i></span>
                                    </div>
                                      <input type="text" name="work_end_time" id="work_end_time" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#doctor_schedule_start_time" required onkeydown="return false" onpaste="return false;" ondrop="return false;" autocomplete="off" />
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

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" />

<script type="text/javascript">

    $('#work_start_time').datetimepicker({
        format: 'HH:mm'
    });

    $('#work_end_time').datetimepicker({
        useCurrent: false,
        format: 'HH:mm'
    });

     $(document).ready(function(){
        $(document).on('click','#addOfficerbtn',function(){
            jQuery.noConflict(); 
            $('#addOfficer').modal('show');
        });
    });

    let firstName = document.querySelector("#officer_first_name");
    let lastName = document.querySelector("#officer_last_name");
    
    let register = document.querySelector("#register");

    let fnameTest;
    let lnameTest;

    firstName.addEventListener("blur", (e) => {
        let fullnameRegex = /^[A-Za-z]{3,15}$/i;
        if (fullnameRegex.test(firstName.value)) {
            e.target.classList.remove("is-invalid");
            e.target.classList.add("is-valid");
            fnameTest = true;
        } else {
            e.target.classList.remove("is-valid");
            e.target.classList.add("is-invalid");
            fnameTest = false;
        }
    });

      lastName.addEventListener("blur", (e) => {
        let fullnameRegex = /^[A-Za-z]{3,15}$/i;
        if (fullnameRegex.test(lastName.value)) {
            e.target.classList.remove("is-invalid");
            e.target.classList.add("is-valid");
            lnameTest = true;
        } else {
            e.target.classList.remove("is-valid");
            e.target.classList.add("is-invalid");
            lnameTest = false;
        }
    });

    setInterval(function() {
        if (fnameTest && lnameTest ) {
            register.removeAttribute("disabled", "disabled");
        } else {
            register.setAttribute("disabled", "disabled");
        }
    }, 500);
    
</script>

@endsection