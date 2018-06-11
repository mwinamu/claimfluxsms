<!-- path edit modal -->
@if( session()->has('data'))
<div id="pathEditModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<h class="modal-title">Edit Path</h>
                <button type="button" class="close" data-dismiss="modal"  aria-hidden="true">&times;</button>
            </div>
            <div id="divCheckbox" style="display: none;">
           {{ $data =  Session::get('data')}}
           </div>
            <div class="modal-body">
                {{ Form::model($data, array('action' => array('PathController@update', $data->id), 'method' => 'PUT')) }}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-10 control-label">Name</label>

                            <div class="col-md-10">
                                <input id ="name" class="form-control" name="name" value="{{$data->name}}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                          <div class="form-group{{ $errors->has('sequence') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-10 control-label">Sequence</label>

                            <div class="col-md-10">
                                <input id="sequence" class="form-control" name="sequence" value="{{$data->sequence}}" required autofocus>

                                @if ($errors->has('sequence'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sequence') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
             			 <div class="modal-footer" >
                            <div class="container" >
                                <div class="form-group">
                                    <div class="col-md-12 col-md-offset-8">

                                        <button type="submit" class="btn btn-primary float-right" style="background-color: dodgerblue">
                                            Edit
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                   	{{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endif
<!-- path delete modal -->
@if( session()->has('delete'))
<div id="pathDeleteModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<h6 class="modal-title">Delete</h6>
                <button type="button" class="close" data-dismiss="modal"  aria-hidden="true">&times;</button>
            </div>
           <div id="divCheckbox" style="display: none;">
           {{ $delete =  Session::get('delete')}}
           </div>
            <div class="modal-body">
            	<h6>Are you sure you wish to preoceed?</h6>
            	{{ Form::model($delete, array('action' => array('PathController@destroy', $delete->id), 'method' => 'DELETE')) }}
                
                  {{ Form::hidden('_method', 'DELETE') }}
                  <div class="container"></div>
                  {{ Form::submit('DELETE',
                   array('class' => 'btn btn-warning')) }}
                   
          		{{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endif
<!-- user edit modal -->
@if( session()->has('user_edit') )
<div id="userEditModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<h6 class="modal-title">Edit User</h6>
                <button type="button" class="close" data-dismiss="modal"  aria-hidden="true">&times;</button>
            </div>
            <div id="divCheckbox" style="display: none;">
           {{ $user =  Session::get('user_edit')}}
           </div>
			<div class="modal-body">
            		{{ Form::model($user, array('action' => array('UserController@update',$user->id), 'method' => 'PUT')) }}

                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} ">
                            <label for="name" class="col-md-10 control-label">Name</label>

                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" required autofocus>

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
                                <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @if( session()->has('user_role') )
                        <div id="divCheckbox" style="display: none;">

                           {{ $roles =  Session::get('user_role')}}
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
                 		@endif

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
                                            Edit
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
		{{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endif
<!-- user delete modal -->
@if( session()->has('user_delete') )
<div id="userDeleteModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<h6 class="modal-title">Delete</h6>
                <button type="button" class="close" data-dismiss="modal"  aria-hidden="true">&times;</button>
            </div>
           <div id="divCheckbox" style="display: none;">
           {{ $delete =  Session::get('user_delete')}}
           </div>
            <div class="modal-body">
            	<h6>Are you sure you wish to preoceed?</h6>
            	{{ Form::model($delete, array('action' => array('UserController@destroy', $delete->id), 'method' => 'DELETE')) }}
                
                  {{ Form::hidden('_method', 'DELETE') }}
                  <div class="container"></div>
                  {{ Form::submit('DELETE',
                   array('class' => 'btn btn-warning')) }}
                   
          		{{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endif
<!-- question edit modal -->
@if( session()->has('question_edit'))
<div id="questionEditModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<h class="modal-title">Edit Question</h>
                <button type="button" class="close" data-dismiss="modal"  aria-hidden="true">&times;</button>
            </div>
            <div id="divCheckbox" style="display: none;">
           {{ $question_edit =  Session::get('question_edit')}}
           </div>
            <div class="modal-body">
                {{ Form::model($question_edit, array('action' => array('QuestionController@update', $question_edit->id), 'method' => 'PUT')) }}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('string') ? ' has-error' : '' }}">
                            <label for="string" class="col-md-10 control-label">Question</label>

                            <div class="col-md-10">
                                <input id ="string" class="form-control" name="string" value="{{$question_edit->string}}" required autofocus>
							
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                          <div class="form-group{{ $errors->has('is_optional') ? ' has-error' : '' }}">
                            <label for="is_optional" class="col-md-10 control-label">Optional</label>

                            <div class="col-md-10">
                                <input id="is_optional" class="form-control" name="is_optional" value="{{$question_edit->is_optional}}" required autofocus>

                                @if ($errors->has('is_optional'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('is_optional') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('is_dichotomous') ? ' has-error' : '' }}">
                            <label for="is_dichotomous" class="col-md-10 control-label">Dichotomous</label>

                            <div class="col-md-10">
                                <input id="is_dichotomous" class="form-control" name="is_dichotomous" value="{{$question_edit->is_dichotomous}}" required autofocus>

                                @if ($errors->has('is_dichotomous'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('is_dichotomous') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      	<div class="form-group{{ $errors->has('sequence') ? ' has-error' : '' }}">
                            <label for="sequence" class="col-md-10 control-label">Sequence</label>

                            <div class="col-md-10">
                                <input id="sequence" class="form-control" name="sequence" value="{{$question_edit->sequence}}" required autofocus>

                                @if ($errors->has('sequence'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sequence') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      
                       <div class="form-group{{ $errors->has('has_options') ? ' has-error' : '' }}">
                            <label for="progress" class="col-md-10 control-label">Has Options</label>

                            <div class="col-md-10">
                                <input id="has_options" class="form-control" name="has_options" value="{{$question_edit->has_options}}" required autofocus>

                                @if ($errors->has('has_options'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('has_options') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('path_id') ? ' has-error' : '' }}">
                            <label for="path_id" class="col-md-10 control-label">Path Id</label>

                            <div class="col-md-10">
                                <input id="path_id" class="form-control" name="path_id" value="{{$question_edit->path_id}}" required autofocus>

                                @if ($errors->has('path_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('path_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
             			 <div class="modal-footer" >
                            <div class="container" >
                                <div class="form-group">
                                    <div class="col-md-12 col-md-offset-8">

                                        <button type="submit" class="btn btn-primary float-right" style="background-color: dodgerblue">
                                            Edit
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                   	{{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endif
<!-- question destroy modal -->
@if( session()->has('question_destroy') )
<div id="questiondestroyModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<h6 class="modal-title">Delete</h6>
                <button type="button" class="close" data-dismiss="modal"  aria-hidden="true">&times;</button>
            </div>
           <div id="divCheckbox" style="display: none;">
           {{ $question_destroy =  Session::get('question_destroy')}}
           </div>
            <div class="modal-body">
            	<h6>Are you sure you want preoceed?</h6>
            	{{ Form::model($question_destroy, array('action' => array('QuestionController@destroy', $question_destroy->id), 'method' => 'DELETE')) }}
                
                  {{ Form::hidden('_method', 'DELETE') }}
                  <div class="container"></div>
                  {{ Form::submit('DELETE',
                   array('class' => 'btn btn-warning')) }}
                   
          		{{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endif

<!-- path add modal -->
@if( session()->has('addPath_code'))
    <div id="addPathModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h class="modal-title">Add Path</h>
                    <button type="button" class="close" data-dismiss="modal"  aria-hidden="true">&times;</button>
                </div>
                <div id="divCheckbox" style="display: none;">
                    {{ $data =  Session::get('data')}}
                </div>
                <div class="modal-body">
                    {{ Form::model($data, array('action' => array('PathController@store'), 'method' => 'POST')) }}
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-10 control-label">Name</label>

                        <div class="col-md-10">
                            <input id ="name" class="form-control" name="name" value="" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('sequence') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-10 control-label">Sequence</label>

                        <div class="col-md-10">
                            <input id="sequence" class="form-control" name="sequence" value="" required autofocus>

                            @if ($errors->has('sequence'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('sequence') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer" >
                        <div class="container" >
                            <div class="form-group">
                                <div class="col-md-12 col-md-offset-8">

                                    <button type="submit" class="btn btn-primary float-right" style="background-color: dodgerblue">
                                        Add
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endif
<!-- question add modal -->
@if( session()->has('addQuestion_code'))
    <div id="addQuestionModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h class="modal-title">Add Question</h>
                    <button type="button" class="close" data-dismiss="modal"  aria-hidden="true">&times;</button>
                </div>
                <div id="divCheckbox" style="display: none;">
                    {{ $paths =  Session::get('paths')}}
                </div>
                <div class="modal-body">
                    {{ Form::model($paths, array('action' => array('QuestionController@store'), 'method' => 'POSt')) }}
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('string') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-10 control-label">Question</label>

                        <div class="col-md-10">
                            <input id ="string" class="form-control" name="string" value="" required autofocus>

                            @if ($errors->has('string'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('string') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('is_optional') ? ' has-error' : '' }}">
                        <label for="is_optional" class="col-md-10 control-label">Optional</label>

                        <div class="col-md-10">
                            {{--<input id="is_optional" class="form-control" name="is_optional" value="" placeholder="USE YES OR NO" required autofocus>--}}
                            <select class="form-control" name="is_optional">
                                <option value="YES">YES</option>
                                <option value="NO">NO</option>
                            </select>
                            @if ($errors->has('is_optional'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('is_optional') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('is_dichotomous') ? ' has-error' : '' }}">
                        <label for="is_dichotomous" class="col-md-10 control-label">Dichotomous</label>

                        <div class="col-md-10">
                            {{--<input id="is_dichotomous" class="form-control" name="is_dichotomous" placeholder="USE YES OR NO" value="" required autofocus>--}}
                            <select class="form-control" name="is_dichotomous">
                                <option value="YES">YES</option>
                                <option value="NO">NO</option>
                            </select>
                            @if ($errors->has('is_dichotomous'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('is_dichotomous') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('sequence') ? ' has-error' : '' }}">
                        <label for="sequence" class="col-md-10 control-label">Sequence</label>

                        <div class="col-md-10">
                            <input id="sequence" class="form-control" name="sequence" value="" required autofocus>

                            @if ($errors->has('sequence'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('sequence') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('has_options') ? ' has-error' : '' }}">
                        <label for="has_options" class="col-md-10 control-label">Has Options</label>

                        <div class="col-md-10">
                            {{--<input id="has_options" class="form-control" name="has_options" value="" placeholder="USE YES OR NO" required autofocus>--}}
                            <select class="form-control" name="has_options">
                                <option value="YES">YES</option>
                                <option value="NO">NO</option>
                            </select>

                            @if ($errors->has('has_options'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('has_options') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('has_multiple') ? ' has-error' : '' }}">
                        <label for="has_multiple" class="col-md-10 control-label">Has Multiple</label>

                        <div class="col-md-10">
                            {{--<input id="has_multiple" class="form-control" name="has_multiple" placeholder="USE YES OR NO" value="" required autofocus>--}}
                            <select class="form-control" id="has_multiple">
                                <option value="YES">YES</option>
                                <option value="NO">NO</option>
                            </select>
                            @if ($errors->has('has_multiple'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('has_multiple') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('path') ? ' has-error' : '' }}">
                        <label for="path" class="col-md-10 control-label">Path</label>

                        <div class="col-md-10">
                            <select class="form-control" name="path" id="path" >

                              @if ($paths->count())

                                 @foreach($paths as $path)

                                     <option value="{{ $path }}" {{ $path ? 'selected="selected"' : '' }}>{{ $path }}</option>

                                 @endforeach
                              @endif

                            </select>
                            @if ($errors->has('path'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('path') }}</strong>
                                    </span>
                            @endif

                        </div>
                    </div>
                    <div class="modal-footer" >
                        <div class="container" >
                            <div class="form-group">
                                <div class="col-md-12 col-md-offset-8">

                                    <button type="submit" class="btn btn-primary float-right" style="background-color: dodgerblue">
                                        Add
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endif
{{-- add options modal--}}
@if( session()->has('addOption_code'))
    <div id="addOptionModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h class="modal-title">Add Option</h>
                    <button type="button" class="close" data-dismiss="modal"  aria-hidden="true">&times;</button>
                </div>
                <div id="divCheckbox" style="display: none;">
                    {{ $path =  Session::get('path')}}
                </div>
                <div class="modal-body">
                    {{ Form::model($path, array('action' => array('OptionController@store'), 'method' => 'POST')) }}
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('option') ? ' has-error' : '' }}">
                        <label for="option"  class="col-md-10 control-label">Option</label>

                        <div class="col-md-10">
                            <select class="form-control" name="option" id="option">
                                <option value="YES">YES</option>
                                <option value="NO">NO</option>
                            </select>

                            @if ($errors->has('option'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('option') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div id="divCheckbox" style="display: none;">
                        {{ $question =  Session::get('question')}}
                    </div>
                    <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                        <label for="question" class="col-md-10 control-label">Question</label>

                        <div class="col-md-10">
                            <select class="form-control" name="question" id="question" >

                                @if ($question->count())

                                    @foreach($question as $question)

                                        <option value="{{ $question }}" {{ $question ? 'selected="selected"' : '' }}>{{ $question }}</option>

                                    @endforeach
                                @endif

                            </select>

                            @if ($errors->has('question'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('path') ? ' has-error' : '' }}">
                        <label for="path" class="col-md-10 control-label">Path</label>

                        <div class="col-md-10">
                            <select class="form-control" name="path" id="path" >

                                @if ($path->count())

                                    @foreach($path as $path)

                                        <option value="{{ $path }}" {{ $path ? 'selected="selected"' : '' }}>{{ $path }}</option>

                                    @endforeach
                                @endif

                            </select>
                            @if ($errors->has('path'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('path') }}</strong>
                                    </span>
                            @endif

                        </div>
                    </div>
                    <div class="modal-footer" >
                        <div class="container" >
                            <div class="form-group">
                                <div class="col-md-12 col-md-offset-8">

                                    <button type="submit" class="btn btn-primary float-right" style="background-color: dodgerblue">
                                        Add
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endif


