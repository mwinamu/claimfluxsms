@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb" style="background-color: steelblue">
                <li class="breadcrumb-item active" style="color:white" >Dispatched</li>

            </ol>
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i>SMS names</div>
                <div class="card-body">
                    <table class="table table-hoverd table-bordered" id="dispatchedAll"></table>
                </div>
            </div>
            <div class="card mb-3"id="datatableRow">
                <div class="card-header">
                    <i class="fa fa-table"></i>Messages of selected SMS names</div>
                <div class="card-body">
                    <table class="table table-hoverd table-bordered" id="dispatchedMessagesAll"></table>
                </div>
            </div>
        </div>
    </div>
@endsection