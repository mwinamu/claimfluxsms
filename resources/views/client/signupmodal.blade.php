<!-- Sign up-->
<div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h class="modal-title" id="exampleModalLabel">Sign up to proceed</h>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="container" >

            <div class="modal-body">
                {{--alert pop up when ticket has been raised succesfully--}}

                <form class="form-horizontal" method="POST" action="{{ url('/signup') }}">
                    {{ csrf_field() }}

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

                    <div class="modal-footer" >
                     <div class="container" >
                         <div class="form-group">
                             <div class="col-md-12 col-md-offset-8">
                                 <button type="submit" class="btn btn-primary float-sm-right " style="background-color: dodgerblue"  >
                                     Sign Up
                                 </button>
                             </div>
                         </div>
                     </div>

                    </div>
                </form>
            </div>

         </div>
    </div>
    </div>
</div>
