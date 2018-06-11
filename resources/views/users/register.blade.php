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
            <div class="row col-md-8 col-lg-8">
                <div class="container col-md-12 ">
                    <div class="content-wrapper col-md-10 ">
                        <div class="container-fluid">
                            <!-- Breadcrumbs-->
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">User</a>
                                </li>
                                <li class="breadcrumb-item active">Registration</li>
                            </ol>
                            <form class="form-horizontal" method="POST" action="{{ route('user.postRegister') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} ">
                                    <label for="name" class="col-md-10 control-label">Name</label>

                                    <div class="col-md-10">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-10 control-label">E-Mail Address</label>

                                    <div class="col-md-10">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-10 control-label">Password</label>

                                    <div class="col-md-10">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm" class="col-md-10 control-label">Confirm Password</label>

                                    <div class="col-md-10">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                    <label for="role" class="col-md-10 control-label">Role</label>

                                    <div class="col-md-10">
                                        <input list="role" type="role" class="form-control" name="role" required>
                                        @foreach( $roles as $role  )
                                            @for ($i = 0 ; $i < count($roles); $i++)

                                                <datalist id="role">
                                                    <option value={{$roles[0]}}>

                                                    <option value={{$roles[1]}}>

                                                    <option value={{$roles[2]}}>

                                                </datalist>

                                            @endfor
                                        @endforeach
                                        @if ($errors->has('role'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                    <label for="id" class="col-md-10 control-label"></label>

                                    <div class="col-md-10">
                                        <input id="id" type="hidden" class="form-control" name="status" value="1" required autofocus>

                                        @if ($errors->has('status'))
                                            <span class="help-block">
                                                            <strong>{{ $errors->first('status') }}</strong>
                                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-md-offset-8">
                                        <button type="submit" class="btn btn-primary float-sm-right">
                                            Register
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
@endsection