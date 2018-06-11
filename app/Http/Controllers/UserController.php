<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Role;
use yajra\Datatables\Datatables;

class UserController extends Controller
{
    
    public  $users;
    
     public function __construct()
    {
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function index()
    {
        $users = User::get(['id', 'name', 'email', 'password', 'created_at', 'updated_at']);
        
        return Datatables::of($users)
        ->addColumn('action', function ($user) {
            return '<a href="/users/'.$user->id.'/edit"><i class="fa fa-pencil fa-fw"></i></a>
            <a href="/users/'.$user->id.'" ><i class="fa fa-trash" aria-hidden="true"></i></a>
            
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
        $delete = User::find( $id );
        
        return Redirect::back()->with('user_delete_code', 99)->with('user_delete', $delete); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
       
        $edit = User::find( $id );
        
        $roles = Role::pluck( 'name' );
       
      /* return view( 'client.editModal' , compact( 'edit', 'roles') ); */
        return Redirect::back()->with('useredit_code', 3)->with('user_edit', $edit)->with('user_role', $roles);
        
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
        $this->validate($request, [
         
            'name' => 'required||string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',

        ]);  
         
    
       $role = $request->get('role');
       $role_administrator = Role::where( 'name' , $role )->first(); 
      
       $users = User::find( $id );
       $users-> name = $request->get( 'name' );
       $users -> status = $request->get( 'status' );
       $users -> email = $request->get( 'email' );
       $users -> password = bcrypt( $request->get( 'password' ));

       $users -> save();  
       $users->roles()->attach( $role_administrator ); 
        
       
       $users->roles()->attach( $role_administrator ); 
       $user_id = $users->id;
       
       return Redirect::back()->with('status', "User $user_id updated succesfully");
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

        $user = User::find($id);
        $user->delete();
        return view('users.index');
        return redirect('users.index')->with('status', 'Deleted updated!');
    }
    
}
