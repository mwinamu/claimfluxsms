<!-- Edit-->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h class="modal-title" id="editModalLabel">User Edit</h>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="container" >

                <div class="modal-body">
                    {{--alert pop up when ticket has been raised succesfully--}}

                    <form class="form-horizontal" method="POST" action="">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} ">
                            <label for="name" class="col-md-10 control-label">Name</label>

                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control" name="name" value=" {{$edit -> name}} " required autofocus>

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
                                <input id="email" type="email" class="form-control" name="email" {{--value="{{ $edit ->email }}"--}} required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
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
                        <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                            <label for="id" class="col-md-10 control-label"></label>

                            <div class="col-md-10">
                                <input id="id" type="hidden" class="form-control" name="id" {{--value="{{ $edit->id }}"--}} required autofocus>

                                @if ($errors->has('id'))
                                    <span class="help-block">
                                                            <strong>{{ $errors->first('id') }}</strong>
                                                        </span>
                                @endif
                            </div>
                        </div>


                        <div class="modal-footer" >
                            <div class="container" >
                                <div class="form-group">
                                    <div class="col-md-12 col-md-offset-8">
                                        <button type="submit" class="btn btn-primary float-sm-right " style="background-color: dodgerblue"  >
                                            Edit
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