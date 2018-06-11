
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

            <!--  Options table-->
            <div class="container-fluid"  id="optionsTable">
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
                <div class="card-header" >
                    <i class="fa fa-table" ></i>Options</div>
                <div class="card-body" >
                    <button  ><a href="{{ route('options.create') }}" class="button">ADD OPTIONS</a></button>

                </div>
                <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="options-table" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>STRING</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

            </div>

            <div class="card-footer small text-muted">Administrator</div>
        </div>


    </div>


@endsection




