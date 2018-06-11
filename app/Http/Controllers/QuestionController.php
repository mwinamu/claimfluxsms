<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Option;
use App\Question;
use App\Answer;
use Psy\Exception\ErrorException;
use yajra\Datatables\Datatables;
use Auth;
use App\Path;
use Illuminate\Database\Eloquent\Collection;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    
    public function index()
    {
      /* all questions querry builder and datatables return to script */
        $questions = Question::get(['id', 'string', 'sequence', 'path_id', 'user_id','progress','is_dichotomous','is_optional','has_options']);

              return Datatables::of($questions)
              ->addColumn('action', function ($question) {
                  return '<a href="/questions/'.$question->id.'/edit"><i class="fa fa-pencil fa-fw"></i></a>
                    <a href="/deletequestion/'.$question->id.'"><i class="fa fa-trash" aria-hidden="true"></i></a>
                 ';
              })
              ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* get paths to be used in drop down*/
        $paths = Path::pluck('name');

        return Redirect::back()->with('addQuestion_code', 8601)->with('paths',$paths);
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
        $this->validate( $request ,[
            'string' => 'required|string',
            'is_optional' => 'required',
            'is_dichotomous' => 'required',
            'sequence' => 'required|int',
            'has_options' => 'required',
            'path' => 'required',
        ]);
        /* get path id for the specified path name */
        $path = PATH::where('name','=',$request->path)->get(['id']);

        foreach ( $path as $path ){
            $path_id = $path->id;
        }

        /* is optional to boolean*/
        if( $request->is_optional == "no" ){
            $is_optional = 0 ;
        }else{
            $is_optional = 1;
        }
        /*is_dichotomous to boolean*/
        if( $request->is_dichotomous == "no" ){
            $is_dichotomous = 0 ;
        }else{
            $is_dichotomous = 1 ;
        }
        /* has options to boolean*/
        if( $request->has_options == "no" ){
            $has_options = 0 ;
        }else{
            $has_options = 1;
        }
        /* has multiple to boolean*/
        if( $request->has_multiple == "no" ){
            $has_multiple = 0 ;
        }else{
            $has_multiple = 1;
        }

        $user = Auth::user();

        /* insert to question db using query builder*/
        $saved = Question::create([
            'string'     => $request->string,
            'is_optional'    => $is_optional,
            'is_dichotomous'    => $is_dichotomous,
            'sequence'    => $request->sequence,
            'has_options'    => $has_options,
            'path_id'    => $path_id,
            'has-multiple' => $has_multiple,
            'user_id' => $user->id,

        ]);


        if($saved){
            return Redirect::back()->with('status', "Question $saved->string added succesfully");
        }else{
            return Redirect::back()->with('status', "Could not add path try later");
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
        //shows options per questions 
     
        $option = Option::where('question_id', $id )->get(['id', 'options_string']);
        
        return Datatables::of($option)->make(true);
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
       /* $question = Question::where('id', $id )->first();*/


        $question = Question::where('id', $id )
        ->get(['id', 'string', 'sequence', 'path_id', 'user_id','progress','is_dichotomous','is_optional','has_options','has_multiple']);

        foreach ( $question as $question ){

            if( $question->is_optional == false ){
                $is_optional = "NO";
            }else{
                $is_optional = "YES";
            }
            if( $question->has_options = false ){
                $has_options = "NO";
            }else{
                $has_options = "YES";
            }if( $question->is_dichotomous = false ){
                $is_dichotomous = "NO";
            }else{
                $is_dichotomous = "YES";
            }
            if( $question->has_multiple = false ){
                $has_multiple = "NO";
            }else{
                $has_multiple = "YES";
            }
            $questions = new Collection;

            $questions->push([
                'id' => $question->id,
                'string' => $question->string,
                'sequence' => $question->sequence,
                'path_id' => $question->path_id,
                'is_dichotomous' => $is_dichotomous,
                'is_optional' => $is_optional,
                'has_multiple' => $has_multiple,
                'has_options' => $has_options,

            ]);
            $question_edit = $questions;


            /*$question_edit = json_encode($questions[0]);*/


        }

        //pass back a variable when redirecting
        return Redirect::back()->with('questionEdit_code', 5)->with('question_edit', $question);
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
    /* validating entries  */
       $validator = $this->validate($request, [
            
            'string' => 'required||string|max:255',
            'sequence' => 'required|int',
            'path_id' => 'required|int',
            'is_dichotomous' => 'required|boolean',
            'is_optional' => 'required|boolean',
            'has_options' => 'required|boolean',
            
        ]); 
       /* getting user id for the current user */
        $user = \Illuminate\Support\Facades\Auth::user()->id;
      
        $questions = Question::find( $id );
        $questions -> string = $request->get( 'string' );
        $questions -> sequence = $request->get( 'sequence' );
        $questions -> path_id = $request->get( 'path_id' );
        $questions -> user_id = $request->get( 'user_id' );
        $questions -> is_dichotomous = $request->get( 'is_dichotomous' );
        $questions -> is_optional = $request->get( 'is_optional' );
        $questions -> has_options = $request->get( 'has_options' );
        $questions-> user_id = $user;
        
        $questions -> save();
        $questions_id = $questions->id;
        //pass back a variable when redirecting
        return Redirect::back()->with('status', "Question $questions_id updated succesfully"); 
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
        $question = Question::find($id);
        $question->delete();
        $question_id = $id;
        return Redirect::back()->with('status', "Path $question_id destroyed"); 
    }
    /* function to handle delete button pressed */
    public function showDestroyAlert($id){
        $question_destroy = Question::find( $id );
        
        //pass back a variable when redirecting
        return Redirect::back()->with('questionDelete_code', 5)->with('question_destroy', $question_destroy);
    }
    public function questionview(){
        
        return view('questions.index');
    }
    public function prevQuestion( Request $request ){
        /*retrieve data from the ajax post request*/
        $currentPathId = "";
        $prevQuestionId = "";
        $currentSequence = "";
        $previousQuestion = "";

        $id = ( json_decode( $request->getContent(), true ) );
        /* db query for current path id*/
        try{
            $currentQuestion = Question::find($id);/*find  current question*/
            $currentPathId = $currentQuestion->path_id;
            $currentSequence = $currentQuestion->sequence;
        } catch(\Illuminate\Database\QueryException $ex){
            echo($ex->getMessage());
        }
        $user_id = Auth::user()->id;/*get current user id*/
        /*using option to get prev question*/
        try{
            $option = Option::where('path_id' ,$currentPathId)->get(['question_id']);

            foreach( $option as $option1){
               //$prevQuestionId = $option1;
                if($option1->question_id != ""){
                    $prevQuestionId = $option1->question_id;
                }else{
                   echo("Question Controller line 290");
                }

            }
        }catch(\Illuminate\Database\QueryException $ex){
            echo($ex->getSql());
        }

        /*using sequence to get the prev question*/
        $prevQuestionPathId = $currentPathId;
        $prevQuestionSequence = $currentSequence -= 1;
        try{
            $question_id = Question::where([['path_id','=',$prevQuestionPathId],['sequence','=',$prevQuestionSequence]])->get(['id']);

            foreach( $question_id as $question_id1 ){
                if( $question_id1->id != "" ){
                    $prevQuestionId = $question_id1->id;
                }else{
                    echo("Question controller line 309");
                }

            }

        }catch(\Illuminate\Database\QueryException $ex){
            return $ex->getSql();
        }
        /*get current question*/
        try{
            $previousQuestion = Question::find($prevQuestionId);
            /*post question using post function in answer controller*/
            $post = app('App\Http\Controllers\AnswerController')->postQuestion($previousQuestion);
            echo($post);

        }catch(\Illuminate\Database\QueryException $ex){
            echo($ex->getSql());
        }

    }
}
