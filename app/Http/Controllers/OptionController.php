<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Option;
use yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Redirect;
use App\Path;
use App\Question;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        $options = Option::get(['id', 'options_string']);

        return Datatables::of($options)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        ///* get paths to be used in drop down*/
        $paths = Path::pluck('name');
        /* get questioons to be used in dropdown*/
        $question = Question::where('has_options','=', '1')->pluck('string');


        return Redirect::back()->with('addOption_code', 8605)->with('path', $paths)->with('question',$question);
       /* dd(" work on add options modal display");*/
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


        /* validation of request*/
        $this->validate( $request ,
            [
                'question' => 'required|string',
                'path' => 'required|string',
                'option' => 'required|string'

        ]);



        /* get path id for the specified path name */
        $path = PATH::where('name','=',$request->path)->get(['id']);

        foreach ( $path as $path ){
            $path_id = $path->id;
        }

        /* get question for specified path name*/
        $question = Question::where('string','=', $request->question)->get(['id']);

        foreach( $question as $question ){
            $question_id  = $question->id;
        }
        $saved = Option::create([
            'question_id' => $question_id,
            'options_string' => $request->option,
            'path_id' => $path_id,
        ]);
        if( $saved ){
            return Redirect::back()->with('status',"Option $saved->option_string added succesfully");
        } else{
            return Redirect::back()->with('status',"Could not add option try again later");
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
    /* options */
    public function optionView(){

        return view('options.index');

    }
}
