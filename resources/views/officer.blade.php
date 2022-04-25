@extends('shared.header')
@section('content')

<nav class="breadcrumb">
    <span class="breadcrumb-item" >Dashboard</span>
    <span class="breadcrumb-item" >Officer</span>
</nav>
 
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
        <tr>
          <td>1</td>
        </tr>
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
                                <input type="text" class="form-control col" placeholder="First name" required="" id="firstname" name="firstname" maxlength="30" autocomplete="off" />
                                <div class="invalid-feedback">Please enter first name.</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="full name">Last Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control col" placeholder=" Last name" required="" id="lastname" name="lastname" maxlength="30" autocomplete="off" />
                                <div class="invalid-feedback">Please enter last name.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="officerPost">Post:<span class="text-danger">*</span></label>
                                <select class="form-control">
                                  <option>CEO</option>
                                  <option>Manager</option>
                                  <option>Senior Developer</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="status">Status:<span class="text-danger">*</span></label><br>
                                <div class="row">
                                    <div class="col-2"></div>
                                    <div class="col-4">
                                        <input class="form-check-input" type="radio" name="status" id="status" checked>
                                        <label class="form-check-label pt-1" for="flexRadioDefault1">
                                            Active
                                        </label>
                                    </div>
                                    <div class="col-4">
                                        <input class="form-check-input" type="radio" name="status" id="status" >
                                        <label class="form-check-label pt-1" for="flexRadioDefault2">
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
                                <input type="text" max="10" class="form-control" id="officerPost" name="officerPost" required="" placeholder="Work Start Time" autocomplete="off" />
                                <div class="invalid-feedback">Enter valid Time</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="phone">Work End Time:<span class="text-danger">*</span></label>
                                <input type="text" max="10" class="form-control" id="Status" name="Status" required="" placeholder="Work End Time" autocomplete="off" />
                                <div class="invalid-feedback">Enter valid Time .</div>
                            </div>
                        </div> 
                    </div>
                    
                    <div class="row my-2">
                        <div class="col mb-3 text-center">
                            <button class="btn btn-info" type="submit">Insert</button>
                        </div>
                    </div>
                </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

     $(document).ready(function(){
        $(document).on('click','#addOfficerbtn',function(){
            jQuery.noConflict(); 
            $('#addOfficer').modal('show');
        });
    });
    
</script>

@endsection