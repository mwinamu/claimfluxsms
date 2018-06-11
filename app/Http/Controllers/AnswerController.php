<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Collection;
use App\Question;
use App\Answer;
use Illuminate\Http\Request;
use App\Option;
use Auth;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( )
    {
        //

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
    public function store( Request $request )
    {        //retrieve data from ajax post request
        $data = ( json_decode( $request->getContent(), true ) );
        //array keys help im manipulating the retrieved data
        $keys = array_keys( $data );
        $question_id =  $data[$keys[0]];
        $answer_string =  $data[$keys[1]];
        $user = Auth::user();
        $user_id = $user->id;
       $update = Answer::where([['user_id','=',$user_id],['question_id','=',$question_id]])->first();

        if ( $update != "" ){
            $answerUpdate = Answer::find($update->id);
            $answerUpdate->string =  $answer_string;
            $answerUpdate->question_id = $question_id;
            $answerUpdate->user_id = $user_id;
            $saved = $answerUpdate->save();
            /*  return   */
            if( $saved ){
                $this->getNextQuestion( $question_id , $answer_string );
            }else{
                echo "NOT SAVED";
            }
        }else{
            /* inserting to answers table*/
            $answer = new Answer();
            $answer->string =  $answer_string;
            $answer->question_id = $question_id;
            $answer->user_id = $user_id;
            $saved = $answer->save();
            /*  return   */
            if( $saved ){
                $this->getNextQuestion( $question_id , $answer_string );
            }else{
                echo "NOT SAVED";
            }
        }

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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getNextQuestion( $id , $option ){
        $question = Question::where('id','=',$id)->get()->all();//get current question values
        foreach( $question as $question1){

            if( $question1->has_options == true ){
                /*retrieve next path from options*/
                $path_id = Option::where([['options_string' ,'=', $option ],['question_id','=',$id]])->pluck('path_id');
                $sequence = 1;
                /*get the next question*/
                $question2 = Question::where([ ['path_id', '=', $path_id],[ 'sequence' ,'=',$sequence]])
                    ->get(['id', 'string', 'sequence', 'path_id', 'user_id','progress','is_dichotomous','is_optional','has_options','has_multiple']);

                foreach ( $question2 as $question3 ){
                    $this->postQuestion( $question3 );
                }
            }elseif( $question1->multiple == true ){
                /*retrieve question using same path next sequence idea*/
                echo("draw a checkbox here");
            }elseif( $question1->has_options == false && $question1->has_multiple == false ){
                $path_id = $question1->path_id;
                $sequence = 2;
                $question4 = Question::where([['path_id', '=', $path_id],['sequence','=',$sequence]])
                    ->get(['id', 'string', 'sequence', 'path_id', 'user_id','progress','is_dichotomous','is_optional','has_options','has_multiple']);

                foreach ( $question4 as $question5 ){
                    $this->postQuestion( $question5 );
                }
            }
            else{
                echo "no request";
            }
        }
    }
    public function postQuestion( $questionDisplay ){
        /* use question id to pluck options for this specific question id*/
        $question_id = $questionDisplay->id;
        $sequence = $questionDisplay->sequence;
        /* if has options get the options div displays */
        if( $questionDisplay->has_options == true ){
            $input_type = "option";
            /*get the div displays*/
            $optionValue = app('App\Http\Controllers\InputController')->index($input_type,$question_id);
            /*get the options*/
            $options = Option::where('question_id', $question_id)->pluck('options_string');
        }elseif ( $questionDisplay->has_multiple == true ){
            echo("get has multiple values");
        }else if ( $questionDisplay->has_options == false && $questionDisplay->has_multiple == false ){
            $input_type = "text";
            /*get the div displays*/
            $optionValue = app('App\Http\Controllers\InputController')->index($input_type,$question_id);
            $options = "";
        }else{
            echo("no reasonable input type ");
        }
        /* creating a new collection instance to fit our required output*/
        $question = new Collection;
        $question->push([
            'id' => $questionDisplay->id,
            'string' => $questionDisplay->string,
            'sequence' => $sequence,
            'options' => $options,
            'optionValue' => $optionValue,

        ]);
        $question = $question[0];
        $question = json_encode($question);
        echo($question);
    }

}
