@extends('layouts.app')
@section('content')

        @if(session()->has('uploaded'))
           <p hidden id="smsTemp">{{ session()->get('uploaded') }}</p>
            <input type="hidden" id="tabListener" value={{ session()->get('tablistener') }}>
        @endif
        @if(session()->has('names'))
            <p hidden id="smsTemp2">{{ session()->get('names') }}</p>
        @endif
        @if(session()->has('msg'))
            <p alert id="smsTemp2">{{ session()->get('msg') }}</p>
        @endif
    <div class="content-wrapper" style="" >
        <div class="container col-md-12">
            @if(session()->has('status'))
                <div class="alert alert-success alert-dismissable">
                    {{ session()->get('status') }}
                </div>

            @endif
        <div class="tab" style="background-color: steelblue">
            <button class="tablinks" onclick="uploadTabs(event, 'Download')" style="color: white">Download Template</button>
            <button class="tablinks" onclick="uploadTabs(event, 'Upload')" style="color: white">Upload</button>
            <button class="tablinks" onclick="uploadTabs(event, 'uploaded-view')" style="color: white" id="upload">Uploaded Template</button>

        </div>
        <div class="row; tabcontent" id="Download" >
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-download"></i>Download SMS template</div>
                <div class="card-body">
                    <a name="downloadLink" class="btn btn-primary"  href="{{ route('teamLeader.excel') }}">DOWNLOAD <i class="fa fa-download"></i></a>
                </div>
            </div>
        </div>
        <div class="row; tabcontent" id="Upload" >
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-upload"></i>Upload CSV Template</div>
                <div class="card-body">
                    <div class="container col-md-6" >
                        {{-- form to post upload starts--}}
                        <form class="form-horizontal" id="postUpload" method="POST" action="{{ route('teamLeader.postUpload') }}"   enctype="multipart/form-data">
                            <br>
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('network') ? ' has-error' : '' }} ">
                                <label for="network" class="col-md-12 control-label">Network</label>

                                <div class="col-md-12">
                                    <select name="network" class="form-control">
                                        <option value="">Select Network</option>
                                        <option value="other">Others</option>
                                        <option value="equitel">Equitel</option>
                                    </select>

                                    @if ($errors->has('network'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('network') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} ">
                                <label for="name" class="col-md-12 control-label">SMS name</label>

                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control" name="name" form="postUpload" value=" " required>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('sms_template') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-12 control-label">Upload SMS template</label>

                                <div class="col-md-12">
                                    <input id="sms_template" type="file" class="form-control" form="postUpload" name="sms_template" {{--value="{{ $edit ->email }}"--}} required>

                                    @if ($errors->has('sms_template'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('sms_template') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="modal-footer" >
                                <div class="container" >
                                    <div class="form-group">
                                        <button type="submit" id="uploadButton"class="btn btn-primary float-sm-right " style="background-color: dodgerblue"  >
                                            SUBMIT
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                        {{-- form to post upload starts--}}
                    </div>
                </div>
            </div>

        </div>
        </div>

        <div class="row; tabcontent" id="uploaded-view" >
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-file-text"></i>Upload message text</div>
                <div class="card-body">
                    {{-- form to post sms messgae starts--}}
                    <form class="form-horizontal" method="POST" action="{{ route('teamLeader.postMessages') }}"  >
                        <br>
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('sms_message') ? ' has-error' : '' }} ">
                            <label for="sms_message" class="col-md-12 control-label">SMS message</label>

                            <div class="col-md-12">

                                <textarea  type="text" name="sms_message"  class="form-control" rows="8" cols="50" required>
                                 </textarea>
                                <div  ondrop="drop(event)" ondragover="allowDrop(event)">

                                </div>

                                @if ($errors->has('sms_message'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sms_message') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group ">

                            <div class="col-md-12">
                                <input id="sms_names_id" type="hidden" class="form-control" name="sms_names_id"  >

                            </div>
                        </div>
                        <div class="modal-footer" >
                            <div class="container" >
                                <div class="form-group">
                                    <button type="submit" id="uploadButton"class="btn btn-primary float-sm-right " style="background-color: dodgerblue"  >
                                        SUBMIT
                                    </button>
                                </div>
                            </div>

                        </div>

                        </br>
                    </form>
                </div>
            </div>
            <div class="card mb-3" id="datatableRow">
                <div class="card-header">
                    <i class="fa fa-file-text"></i>Uploaded csv entries</div>
                <div class="card-body">
                    <table class="table table-bordered " id="uploaded-template" ></table>
                </div>
            </div>


        </div>
        </div>

        </div>

@endsection
