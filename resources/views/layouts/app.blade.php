<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  {{--<meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <!-- Bootstrap core CSS-->
    <link href="{{ asset('css/admin/bootstrap.min.css') }}" rel="stylesheet">
        
    <!-- Custom fonts for this template-->
    <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <!-- Page level plugin CSS-->
	 <link href="{{ asset('css/jquery.dataTables.css') }}" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/admin/sb-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/button/buttons.dataTables.min.css') }}" rel="stylesheet">

    <style>
        body {font-family: Arial;}

        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: steelblue;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
       /* table { table-layout: fixed; }

        td {
            overflow: hidden;
            text-overflow: ellipsis;
        }*/
        /* preventing overlapping*
        /

    </style>
	 

</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="">{{ config('app.name') }}</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            @if( Auth::user()->hasRole('TeamLeader'))
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="{{ route('teamLeader.dashboard') }}">
                        <i class="fa fa-dashboard"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
            @endif
            @if( Auth::user()->hasRole('HeadsofOperations'))
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="{{ route('operationsHead.dashboard') }}">
                        <i class="fa fa-dashboard"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
            @endif

                    @if( Auth::user()->hasRole('administrator'))
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
                        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
                            <i class="fa fa-fw fa-users"></i>
                            <span class="nav-link-text">Users</span>
                        </a>
                        <ul class="sidenav-second-level collapse" id="collapseExamplePages">
                        	 <li>
                               <a href="{{ route('admin.user') }}" class="fa fa-fw fa-list">Users</a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}" class="fa fa-fw fa-edit">Register</a>
                            </li>
                           

                        </ul>

                    </li>
                    @endif
                   {{-- team leader nav bar elements--}}
                    @if( Auth::user()->hasRole('TeamLeader'))
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Upload">
                            <a class="nav-link" href="{{ route('teamLeader.upload') }} ">
                                <i class="fa fa-dashboard"></i>
                                <span class="nav-link-text">Upload</span>
                            </a>
                        </li>
                    @endif
                    @if( Auth::user()->hasRole('TeamLeader'))
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dispatched">
                            <a class="nav-link" href="{{ route('teamLeader.dispatched') }}" >
                                <i class="fa fa-dashboard"></i>
                                <span class="nav-link-text">Dispatched</span>
                            </a>
                        </li>
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Awaiting Dispatch">
                            <a class="nav-link" href="{{ route('teamLeader.awaitingDispatch') }}">
                                <i class="fa fa-dashboard"></i>
                                <span class="nav-link-text">Awaiting Dispatch</span>
                            </a>
                        </li>
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Rejected">
                            <a class="nav-link" href="{{ route('teamLeader.rejected') }}" >
                                <i class="fa fa-dashboard"></i>
                                <span class="nav-link-text">Rejected</span>
                            </a>
                        </li>
                    @endif
                    {{-- head of operations nav bar elements--}}
                    @if( Auth::user()->hasRole('HeadsofOperations'))
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dispatched">
                            <a class="nav-link" href="{{ route('operationsHead.dispatched') }}">
                                <i class="fa fa-dashboard"></i>
                                <span class="nav-link-text">Dispatched</span>
                            </a>
                        </li>
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Awaiting Dispatch">
                            <a class="nav-link" href="{{ route('operationsHead.awaitingDispatch') }}">
                                <i class="fa fa-dashboard"></i>
                                <span class="nav-link-text">Awaiting Dispatch</span>
                            </a>
                        </li>
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Rejected">
                            <a class="nav-link" href="{{ route('operationsHead.rejected') }}">
                                <i class="fa fa-dashboard"></i>
                                <span class="nav-link-text">Rejected</span>
                            </a>
                        </li>
                    @endif


        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto" >

    
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#logoutModal">
                        <i class="fa fa-fw fa-sign-out"></i>{{ Auth::user()->name }}</a>
                </li>
   

        </ul>

    </div>

</nav>
{{--alert pop up when updated  succesfully--}}

@yield('content')

<!-- /.content-wrapper-->
<footer class="sticky-footer">
    <div class="container">
        <div class="text-center">
            <small>Copyright © {{ config('app.name') }} 2018</small>
        </div>
    </div>
</footer>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                    Logout

                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</div>
@include('includes.modals')

<!-- Bootstrap core JavaScript-->
 <script src="{{ asset('js/admin/jquery.min.js') }}"></script>
 <script src="{{ asset('js/admin/popper.min.js') }}"></script>
 
<script src="{{ asset('js/admin/bootstrap.min.js') }}"></script>

<script src="{{ asset('js/admin/jquery.easing.min.js') }}"></script>
<script src=" {{ asset('js/jquery.dataTables.js') }}"></script>

<script src=" {{ asset('js/dataTables.hideEmptyColumns.js') }}"></script>

<script src="{{ asset('js/admin/sb-admin.min.js') }}"></script>

<script src="{{ asset('js/buttons/buttons.flash.min.js') }}"></script>
<script src="{{ asset('js/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/buttons/jszip.min.js') }}"></script>
<script src="{{ asset('js/buttons/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/buttons/vfs_fonts.js') }}"></script>




@include('includes.script')
@include('includes.uploadScript')
@include('includes.awaitingDispatchScript')
@include('includes.dispatchedScript')
@include('includes.rejectedScript')
@include('includes.dashboardScript')
@include('includes.userScript')
@include('operationsHead.dashboardScript')
@include('operationsHead.awaitingDispatchScript')
@include('operationsHead.dispatchedScript')
@include('operationsHead.rejectedScript')
</body>
</html>