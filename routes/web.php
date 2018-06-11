<?php

use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   return view('landing');
})
->name('landing');

Auth::routes();
Route::resource( 'users' , 'UserController' );
Route::post( '/user/postRegister' , 'UserController@postRegister' )->name('user.postRegister')->middleware('auth');
Route::get( '/users/register' , 'UserController@register' )->name('users.register')->middleware('auth');
Route::get( '/home' , 'HomeController@index')->name('home');
Route::get( '/admin' , 'AdminController@dashboard' )->name('admin.dashboard')->middleware('auth');
Route::get( '/admin/user' , 'AdminController@userView')->name('admin.user')->middleware('auth');

/* team leader routes*/
Route::get( '/teamLeader' , 'TeamLeaderController@dashboard' )->name('teamLeader.dashboard')->middleware('auth');
Route::get( '/sms' , 'TeamLeaderController@upload' )->name('teamLeader.upload')->middleware('auth');
Route::get( '/excel' , 'TeamLeaderController@excel' )->name('teamLeader.excel')->middleware('auth');
Route::post( '/sms/upload' , 'TeamLeaderController@postUpload' )->name('teamLeader.postUpload')->middleware('auth');
Route::get( '/sms/upload/sms_name' , 'TeamLeaderController@uploadedSmsName' )->name('teamLeader.uploadedSmsName')->middleware('auth');
Route::get( '/sms/upload/sms_template' , 'TeamLeaderController@uploadedSmsTemplate' )->name('teamLeader.uploadedSmsTemplate')->middleware('auth');
Route::get( '/sms/upload/getSmsNamesId' , 'TeamLeaderController@getSmsNamesId' )->name('teamLeader.getSmsNamesId')->middleware('auth');
Route::get( '/sms/upload/parameterValues' , 'TeamLeaderController@parameterValues' )->name('teamLeader.parameterValues')->middleware('auth');
Route::post( '/sms/post/messages' , 'TeamLeaderController@postMessages' )->name('teamLeader.postMessages')->middleware('auth');
Route::get( '/sms/get/awaitingDispatch' , 'TeamLeaderController@awaitingDispatch' )->name('teamLeader.awaitingDispatch')->middleware('auth');
Route::get( '/sms/get/getDispatched' , 'TeamLeaderController@getDispatched' )->name('teamLeader.getDispatched')->middleware('auth');
Route::get( '/sms/get/getRejected' , 'TeamLeaderController@getRejected' )->name('teamLeader.getRejected')->middleware('auth');
Route::get( '/sms/get/dispatched' , 'TeamLeaderController@dispatched' )->name('teamLeader.dispatched')->middleware('auth');
Route::get('/sms/sms_names', 'TeamLeaderController@smsNames')->name('teamLeader.smsNames')->middleware('auth');
Route::post('/sms/GetSmsTemplate', 'TeamLeaderController@GetSmsTemplate')->name('teamLeader.GetSmsTemplate')->middleware('auth');
Route::get('/sms/user/sms_names','TeamLeaderController@userSmsNames')->name('teamLeader.userSmsNames')->middleware('auth');
Route::get('/sms/sms_names/awaiting','TeamLeaderController@awaiting')->name('teamLeader.awaiting')->middleware('auth');
Route::get('/sms/sms_names/rejected','TeamLeaderController@rejected')->name('teamLeader.rejected')->middleware('auth');
/* head of operations routes*/
Route::get('/sms/operationsHead/Dashboard','OperationsHeadController@dashboard')->name('operationsHead.dashboard')->middleware('auth');
Route::get('/sms/operationsHead/awaitingDispatch','OperationsHeadController@awaitingDispatch')->name('operationsHead.awaitingDispatch')->middleware('auth');
Route::get('/sms/operationsHead/dispatched','OperationsHeadController@dispatched')->name('operationsHead.dispatched')->middleware('auth');
Route::get('/sms/operationsHead/rejected','OperationsHeadController@rejected')->name('operationsHead.rejected')->middleware('auth');
Route::get( '/sms/operationsHead/get/getDispatched' , 'OperationsHeadController@getDispatched' )->name('operationsHead.getDispatched')->middleware('auth');
Route::get( '/sms/operationsHead/get/getRejected' , 'OperationsHeadController@getRejected' )->name('operationsHead.getRejected')->middleware('auth');
Route::get( '/sms/operationsHead/get/awaiting' , 'OperationsHeadController@awaiting' )->name('operationsHead.awaiting')->middleware('auth');
Route::get( '/sms/operationsHead/get/smsNames' , 'OperationsHeadController@smsNames' )->name('operationsHead.smsNames')->middleware('auth');
Route::post( '/sms/operationsHead/post/DispatchedSMS' , 'OperationsHeadController@postDispatchedSMS' )->name('operationsHead.postDispatchedSMS')->middleware('auth');
Route::get( '/sms/usent' , 'OperationsHeadController@unsentSMS' )->name('operationsHead.unsentSMS')->middleware('auth');
/*/*Route::get( '/singup' ,  'ClientController@ShowSignUp')->name('client.signup');
Route::post( '/singup' ,  'ClientController@ShowSignUp')->name('client.signup');
Route::post( '/signup' , 'ClientController@SignUp')->name('signup');
Route::get( '/signup' , 'ClientController@SignUp')->name('signup');
Route::get( '/client' , 'ClientController@client_view')->name('client.client')->middleware('auth');

Route::resource( 'options' , 'OptionController' );
Route::resource( 'questions' , 'QuestionController' );

Route::resource( 'paths' , 'PathController' );
Route::resource( 'surveys' , 'SurveyController' );
Route::resource( 'answers' , 'AnswerController' );
Route::resource( 'clients' , 'ClientController' );
Route::get( '/path' , 'PathController@viewPaths')->name('paths')->middleware('auth');
Route::get( '/editpath' , 'PathController@editFormDetails')->name('editpath')->middleware('auth');
Route::get( '/deletepath/{id}' , 'PathController@deleteFormDetails')->name('deletepath')->middleware('auth');
Route::get( '/deletequestion/{id}' , 'QuestionController@showDestroyAlert')->name('deletequestion')->middleware('auth');
Route::get( '/question' , 'QuestionController@questionview')->name('questions')->middleware('auth');
Route::post( '/survey' , 'SurveyController@surveyAnswer')->name('survey');
Route::get( '/survey' , 'SurveyController@surveyAnswer')->name('survey');
Route::get( '/option' , 'OptionController@optionView')->name('options')->middleware('auth');
Route::get('/end','SurveyController@endSurvey')->name('end')->middleware('auth');
Route::get('/input','InputController@index')->middleware('auth');
Route::get('/next_question','AnswerController@getNextQuestion')->middleware('auth');
Route::get('/question_display','AnswerController@postQuestion')->middleware('auth');
Route::post('/prev_question', 'QuestionController@prevQuestion')->name('previousQuestion')->middleware('auth');
Route::get('/session','SurveyController@session')->name('session');*/





