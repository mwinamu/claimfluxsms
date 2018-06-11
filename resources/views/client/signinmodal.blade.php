<!-- Sign In-->
<div class="modal fade" id="signinModal" tabindex="-1" role="dialog" aria-labelledby="signinModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h class="modal-title" id="signinModalLabel">Sign In</h>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="container" >

                <div class="modal-body2">

                     <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-10 control-label">E-Mail Address</label>

                            <div class="col-md-10">
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
                            <div class="col-md-10 col-md-offset-8">
                                <div class="checkbox ">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                             <div class="col-md-10 col-md-offset-8">
                                 <div class="checkbox ">
                                     <a class="nav-link" data-toggle="modal" id="sigIn" data-target="#signinModal">
                                         <i i class="btn btn-link">Not yet registered?</i>
                                     </a>
                                     <a class="btn btn-link float-left" id="forgotPassword"  >
                                         <i i class="btn btn-link">Forgot Your Password?</i>
                                     </a>
                                 </div>
                             </div>
                         </div></br>



                        <div class="modal-footer" >
                            <div class="container" >
                                <div class="form-group">
                                    <div class="col-md-12 col-md-offset-8">

                                        <button type="submit" class="btn btn-primary float-right" style="background-color: dodgerblue">
                                            Sign In
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