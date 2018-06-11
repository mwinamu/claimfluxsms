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


</head>
<body class="bg-dark">
<div class="container col-md-4" >
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">Delete 
            <a href = "{{ route('admin.user') }}" class="close">&times;</a>
        </div>
        <div class="container-fluid ">

        <div class="card-body">
		 {{ Form::open(array('url' => 'users/' . $delete->id, 'class' => 'centre')) }}
                  {{ Form::hidden('_method', 'DELETE') }}
                  <div class="container"></div>
                  {{ Form::submit('are you sure you want to this User?',
                   array('class' => 'btn btn-warning')) }}
                   
          {{ Form::close() }}

        </div>
    </div>
</div>
</div>
<!-- Bootstrap core JavaScript-->

<script src="{{ asset('js/admin/bootstrap.min.js') }}"></script>

</html>