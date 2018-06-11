@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb" style="background-color: steelblue">
                <li class="breadcrumb-item active" style="color: white">Dashboard</li>

            </ol>
            @if(session()->has('status'))
                <div class="alert alert-success alert-dismissable">
                    {{ session()->get('status') }}
                </div>

            @endif
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i>SMS names</div>
                <div class="card-body">
                    <table class="table table-hoverd table-bordered" id="sms_namesAll"></table>
                </div>
            </div>
            </br>
            <div class="card mb-3" id="datatableRow">
                    <div class="card-header">
                        <i class="fa fa-table"></i>Messages of selected SMS names</div>
                    <div class="card-body">
                        <table class="table table-hoverd table-bordered" id="sms_namesMessagesAll">

                        </table>

                    </div>
            </div>

            </br>
        </div>
    </div>
@endsection