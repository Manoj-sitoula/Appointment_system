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
<table class="table">
    <thead>
        <tr>
            <th colspan="10">
            </th>
            <th colspan="1">
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addActivity">
                  Add New
                </button>
            </th>
        </tr>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Officer Id</th>
          <th scope="col">Visitor Id</th>
          <th scope="col">Name</th>
          <th scope="col">Type</th>
          <th scope="col">Status</th>
          <th scope="col">Date</th>
          <th scope="col">Start Time</th>
          <th scope="col">End Time</th>
          <th scope="col">Added On</th>
          <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $value as $data)
        <tr>
            <td>{{$data->id}}</td>
            <td>{{$data->officer_id}}</td>
            <td>{{$data->visitor_id}}</td>
            <td>{{$data->name}}</td>
            <td>{{$data->type}}</td>
            @if ($data->status == 'active')
                <td>
                    <form action="" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" name="activity_id" id="activity_id" value="{{$data->id}}">
                        <input type="hidden" name="status_value" id="status_value" value="{{$data->status}}">
                        <button class="btn btn-sm btn-success">Active</button>
                    </td>
                    </form>
                    
            @elseif($data->status == 'inactive')
                <td>
                    <form action="" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" name="activity_id" id="activity_id" value="{{$data->id}}">
                        <input type="hidden" name="status_value" id="status_value" value="{{$data->status}}">
                    <button class="btn btn-sm btn-danger">InActive</button>
                    </form>
                    
                </td>
            @endif
            <td>{{$data->date}}</td>
            <td>{{$data->start_time}}</td>
            <td>{{$data->end_time}}</td>
            <td>{{$data->added_on}}</td>
            <td>
                <div class="row">
                    <div class="col-lg-4 col-xl-5 col-md-12 col-sm-12 col">
                        <button type="button" class="btn btn-info btn-sm" id="updatebtn" data-bs-toggle="modal" data-bs-target="#updateActivity" value="{{$data->id}}">Update</button>
                    </div>
                    <div class="col-lg-5 col-xl-5 col-md-12 col-sm-12">
                        <button class="btn btn-info btn-sm">Cancel</button>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    
</table>
@endsection