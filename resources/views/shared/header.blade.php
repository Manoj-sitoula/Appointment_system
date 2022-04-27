<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" >
    <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.css')}}" >
    <link rel="stylesheet" href="{{asset('assets/css/chosen.min.css')}}" >

    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.min.js')}}" ></script>
    <script src="{{asset('assets/js/jquery-ui.min.js')}}" ></script>
    <script src="{{asset('assets/js/chosen.jquery.min.js')}}" ></script>

	<title>Office Appointment System</title>
    <style type="text/css">
        a{
            text-decoration: none!important;
            color: white;
        }
    </style>
</head>
<body>
	<div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <ul class="list-unstyled components">
                <p>Appointment System</p>
                <li>
                    <a href="/">Dashboard</a>
                </li>
                <li>
                    <a href="{{route('officer')}}">Officer</a>
                </li>
                <li>
                    <a href="{{route('visitor')}}">Visitor</a>
                </li>
                <li>
                    <a href="{{route('activity')}}">Activity</a>
                </li>

            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h3 class="mx-auto">Office Appointment Management System</h3>
                </div>
            </nav>

            @yield('content')
   
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
    
</body>
</html>
