
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
            <!-- Paths Table-->
            <div class="container-fluid"  id="paths_table">
          
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
                    <div class="card-header">
                        <i class="fa fa-table"></i>Paths</div>
                        <div class="card-body" >
                            <button type="button"  id="addPath" style="" href="paths/create" >ADD PATH</button>
                        </div>
                    <div class="card-body">

                    <div class="table-responsive">
                            <table class="table table-bordered" id="paths-table" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                               		<th>NAME</th>
                                 	<th>SEQUENCE</th>
                                 	<th>ACTIONS </th>
                                  </tr>
                                </thead>
                             </table>
                        </div>
                    </div>
               </div> 
                <!--  Questions per path-->
              <div class="container-fluid"  id="questions_table">
              	 <div class="card-header" >
                    <i class="fa fa-table" ></i>Questions</div>
             		<div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-bordered" id="questions-table" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                      		 <th>QUESTIONS</th>
                                      		 <th>OPTIONAL</th>
                                      		 <th>DICHOTOMOUS</th>
                                      		 <th>SEQUENCE</th>
                                      		 <th>WITH OPTIONS</th>
                                      		 <th>PROGRESS</th>
                                      		 <th>PATH ID </th>
                                      		 <th>ACTIONS </th>
                                      		 
                                         </tr>
                                        </thead>
                                     </table>
                               </div> 
                </div>
              </div>
            <!--Options per question-->
            <div class="container-fluid"  id="options_table">
                <div class="card-header">
                    <i class="fa fa-table"></i>Options</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="questionsOptions-table" width="100%" cellspacing="0">
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




