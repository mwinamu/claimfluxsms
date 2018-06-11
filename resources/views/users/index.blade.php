
@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Administrator</li>
            </ol>
            <!-- Example DataTables Card-->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i>Users</div>
                    @if(session()->has('status'))
                        <div class="alert alert-success alert-dismissable">
                          {{ session()->get('status') }}
                        </div>
        			
    				@endif
    				    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
    				@endif
                   <font size="2">
                <div class="card-body">
                <div class="table-responsive">
                        <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>CREATED AT</th>
                                <th>UPDATED AT</th>
                                <th>ACTIONS</th>
                             </tr>
                            </thead>
                          
                        
                        </table>
                    </div> 
                </div>
                   </font>
                <div class="card-footer small text-muted">Administrator user view</div>
            </div>
        </div>
    </div>

@endsection




