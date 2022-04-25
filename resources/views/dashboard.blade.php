
@extends('shared.header')
@section('content')

<nav class="breadcrumb">
    <span class="breadcrumb-item" >Dashboard</span>
</nav>
        <main>
            <div class="container-fluid">
                <div class="container-fluid">
                	
                </div>
	                <div class="container-fluid mt-lg-3">
	                    <div class="row justify-content-center my-md-3 mb-sm-3">
	                        <div class="col-lg-4 d-flex justify-content-center mb-2">
	                            <div class="card card-stats card-warning w-75 bg-info">
	                                <div class="card-body ">
	                                    <div class="row">
	                                        <div class="col-2">
	                                            <div class="icon-big text-center h1 my-3">
	                                                <i class="fas fa-user text-white"></i>
	                                            </div>
	                                        </div>
	                                        <div class="col-10 d-flex align-items-center">
	                                            <div class="numbers">
	                                                <p class="card-category text-white h4">Officer</p>
	                                                <h5 class="card-title text-center text-white">
	                                                    80</h5>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>

	                        </div>
	                        <div class="col-lg-4 d-flex justify-content-center mb-2">

	                            <div class="card card-stats card-warning w-75 bg-primary">
	                                <div class="card-body ">
	                                    <div class="row">
	                                        <div class="col-2">
	                                            <div class="icon-big text-center h1 my-3">
	                                                <i class="fas fa-user-md text-light"></i>
	                                            </div>
	                                        </div>
	                                        <div class="col-10 d-flex align-items-center">
	                                            <div class="numbers">
	                                                <p class="card-category text-white h4">Visitor</p>
	                                                <h5 class="card-title text-center text-white">
	                                                    40</h5>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>

	                        </div>
	                        <div class="col-lg-4 d-flex justify-content-center  mb-2">
	                            <div class="card card-stats card-warning w-75" style="background-color: teal;">
	                                <div class="card-body ">
	                                    <div class="row">
	                                        <div class="col-2">
	                                            <div class="icon-big text-center h1 my-3">
	                                                <i class="fas fa-users text-light"></i>
	                                            </div>
	                                        </div>
	                                        <div class="col-10 d-flex align-items-center">
	                                            <div class="numbers">
	                                                <p class="card-category text-white h4">Appointments</p>
	                                                <h5 class="card-title text-center text-white">
	                                                    50</h5>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
                    </div>
                </div>

            </div>
        </main>
@endsection