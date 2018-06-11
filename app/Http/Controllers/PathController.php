<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Path;
use App\Question;
use yajra\Datatables\Datatables;


class PathController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $id;
   
    public function index()
    {
        //
        $paths = Path::get(['id', 'name', 'sequence']);
       
        return Datatables::of($paths)
        ->addColumn('action', function ($path) {
            return '<a href="/paths/'.$path->id.'/edit"  ><i i class="fa fa-pencil fa-fw"></i></a>
            <a href="/deletepath/'.$path->id.'" ><i class="fa fa-trash" aria-hidden="true"></i></a>   
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
        //
        //pass back a variable when redirecting

        return Redirect::back()->with('addPath_code', 8600);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* validations*/
         $this->validate($request,
        [
            'name' => 'required',
            'sequence' => 'required|int',

        ]);

        $saved = Path::create([
        'name'     => $request->name,
        'sequence'    => $request->sequence,

         ]);

        if($saved){
            return Redirect::back()->with('status', "Path $saved->name added succesfully");
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
        /*  shows questions per path*/
   
        $questions = Question::where('path_id', $id )->get(['id', 'string', 'sequence', 'path_id', 'user_id','progress','is_dichotomous','is_optional','has_options']);
  
        return Datatables::of($questions)
        ->addColumn('action', function ($question) {
            return '<a href="/questions/'.$question->id.'/edit" ><i i class="fa fa-pencil fa-fw"></i></a>
            <a href="/deletequestion/'.$question->id.'" ><i class="fa fa-trash" aria-hidden="true"></i></a>
            ';
        })
        ->make(true);
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
        $this->id = $id;
       
        $edit = Path::find( $this->id );
       
        //pass back a variable when redirecting
        return Redirect::back()->with('error_code', 5)->with('data', $edit); 
       
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
          $this->validate($request, [
          
              'name' => 'required||string|max:255',
               'sequence' => 'required',
            
        ]);  
        
        $paths = Path::find( $id );
        $paths-> name = $request->get( 'name' );
        $paths -> sequence = $request->get( 'sequence' );
     
        $paths -> save();
        $path_id = $paths->id;
        //pass back a variable when redirecting
        return Redirect::back()->with('status', "Path $path_id updated succesfully"); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //deleting path with notification of succesful deletion
        
        $path = Path::find($id);
        $path->delete();
        $path_id = $id;
        return Redirect::back()->with('status', "Path $path_id destroyed"); 
    }
    /* 
     * return paths view
     *  */
    public function viewPaths(){
        
        return view('paths.index');

    }

    
    public function deleteFormDetails($id){
        
        $delete = Path::find( $id );
      
        return Redirect::back()->with('delete_code', 5)->with('delete', $delete); 
     
    }
    
}
