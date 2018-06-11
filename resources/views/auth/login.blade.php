<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ config('app.name') }}</title>
    <!-- Bootstrap core CSS-->
    <link href="{{ asset('css/admin/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/admin/sb-admin.css') }}" rel="stylesheet">

</head>
<body class="bg-white">
<div class="row">

    <div class="container-fluid ">

        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissable">
                {{ session()->get('message') }}
            </div>
    </div>

    @endif
</div>

<div class="container col-md-4" >
    <div class="card card-register mx-auto mt-5">
        <div class="card-header" style="background-color: steelblue"><h6 style="color: white"> LOGIN</h6>
        </div>

        <div class="card-body">

            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-10 control-label">Email address</label>

                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-10 control-label">Password</label>

                    <div class="col-md-12">
                        <input id="password" type="password"  file="csv" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <div class="checkbox ">
                            <label>
                                {{-- <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me--}}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="row col-md-offset-2">
                        <button type="submit" class="btn btn-primary col-md-12 " style="background-color: steelblue">
                            LOGIN
                        </button></br>

                    </div>
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/admin/popper.min.js') }}"></script>
<script src="{{ asset('js/admin/bootstrap.min.js') }}"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset('js/admin/jquery.easing.min.js') }}"></script>
<!-- Custom scripts for all pages-->
<script src="{{ asset('js/admin/sb-admin.min.js') }}"></script>
</body>
</html>