<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Option;
use App\Question;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Response;
use App\Path;
use App\Answer;
use App\Http\Controllers\InputController;
use Auth;


class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*member variables*/
        $options = "";
        $optionValue = "";
        /* confirm if user had logged in in before and started a survey*/
        $user = Auth::user();
        $answer = Answer::where('user_id','=',$user->id)->get()->last();

        if( $answer != "" ){
            $question_id = $answer->question_id;
            $answer_string = $answer->string;

            /*get next question using function getNextQuestion in answer controller*/
            $displayQuestion = app('App\Http\Controllers\AnswerController')->getNextQuestion($question_id,$answer_string);

            return $displayQuestion;
            /* use post question to work */
        }else{
            /*if user has never done a the survey before get first question*/
            /*fetch every paths*/
            $paths = Path::get(['id', 'name', 'sequence']);
            If( sizeof($paths)>0 ) {
                // fetch path where sequence == 1
                $sequence = "1";
                $path_id = "";
                $paths = Path::where('sequence',$sequence)->get(['id', 'name', 'sequence']);
                foreach( $paths as $path ){
                    $path_id = $path->id;
                }
                $questions = Question::where('path_id' , '=' ,$path_id/*[['sequence', '=', $sequence], ['path_id', '=', 1]]*/)
                    ->get(['id', 'string', 'sequence', 'path_id', 'user_id', 'progress', 'is_dichotomous', 'is_optional', 'has_options']);
                foreach ($questions as $questions) {
                    /* use question id to pluck options for this specific question id*/
                    $question_id = $questions->id;
                    $sequence = $questions->sequence;
                    /* if has options get the options div displays */
                    if( $questions->has_options == true ){
                        $input_type = "option";
                        /*get the div displays*/
                        $optionValue = app('App\Http\Controllers\InputController')->index($input_type,$question_id);
                        /*get the options*/
                        $options = Option::where('question_id', $question_id)->pluck('options_string');

                    }elseif ( $questions->has_multiple == true ){

                        echo("get has multiple values");

                    }else if ( $questions->has_options == false && $questions->has_multiple == false ){

                        echo("both values of has multiple and has options is false");

                    }else{

                        echo("no reasonable input type ");

                    }
                    /* creating a new collection instance to fit our required output*/
                    $question = new Collection;

                    $question->push([
                        'id' => $questions->id,
                        'string' => $questions->string,
                        'sequence' => $sequence,
                        'options' => $options,
                        'optionValue' => $optionValue,

                    ]);
                    $question = $question[0];
                    $question = json_encode($question);

                    return $question;

                }

            }
            else{
                echo "CANNOT COMPLETE REQUEST";
            }
        }


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
        //
    }
    public function session(){
        $user = Auth::user();
        if( $user == "" ){
            echo("Deny");
        }else{
            $roles = $user -> authorizeRoles('client');
            if( $roles == 1 ){
                echo("Allow");
            }else
             if( $roles == 0 )   {
                echo("Deny");
            }
            else{
                echo("Deny");
            }
        }
    }

}
