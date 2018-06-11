@extends('layouts.app')
@section('content')

    <div class="content-wrapper">
            {{-- dispatched succesfully alert --}}
            @if(session()->has('res'))
            <div class="alert">
                <div class="alert alert-success alert-dismissable">
                    {{ session()->get('res') }}
                </div>
            </div>
            @endif
            {{--res messages --}}
            {{--@if(session()->has('sendRes'))
            <div class="alert">
                <p id="smsTemp2" type="hidden">{{ session()->get('sendRes') }}</p>
            </div>
            @endif--}}

        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb" style="background-color: steelblue">
                <li class="breadcrumb-item active" style="color:white" >Awaiting Dispatch</li>

            </ol>
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i>SMS names</div>
                <div class="card-body">
                    <table class="table table-hoverd table-bordered" id="awaiting_Dispatch"></table>
                </div>
            </div>
            <div class="card mb-3"id="datatableRow">
                <div class="card-header">
                    <i class="fa fa-table"></i>Messages of selected SMS names</div>
                <div class="card-body">
                    <table class="table table-hoverd table-bordered" id="awaiting_DispatchMessages"></table>
                    <form class="form-horizontal" method="POST" action="{{ route('operationsHead.postDispatchedSMS') }}"  >
                        <br>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input id="sms_namesID" type="hidden" class="form-control" name="sms_names_id"  >
                            <button type="submit" id="uploadButton"class="btn btn-primary float-sm-left " style="background-color: dodgerblue"  >
                                Dispatch SMS'S
                            </button>
                        </div>

                    </form>
                </div>

            </div>

            </div>
        </div>
    </div>
@endsection