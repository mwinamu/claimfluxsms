<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        /*
         * if login request has user with
         * administrator role
         * */

        if( $request->user()->hasRole('administrator')  == true ){

        return view('admin/dashboard');

        }
        /*
         * if login request has user with
         * teamLeader role
          * */
        else if( $request->user()->hasRole('TeamLeader') == true ){
        /*change to team leader view*/
        return view('teamLeader/dashboard');

        }
        /*
         * if login request has user with
         * teamLeader role
         * */
        else if( $request->user()->hasRole('HeadsofOperations') == 1 ){
            return view('operationsHead.dashboard');
        }else{
            return Redirect::back()->with('message',"Invalid Login");

        }

    }
    public function teamLeader(){
        return view( 'teamLeader.dashboard' );
    }


}
