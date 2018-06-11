<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class ClientController extends Controller
{
    //
    public function ShowSignUp(){

        return view ( 'client.signup' );
    }
    public function SignUp( Request $request){

        /* validation */ 
        $this->validate( $request,[
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',

        ]);

        $data = $request->all();


        $user = User::create([
            'name'     => $data['email'],
            'email'    => $data['email'],
            'status'   => $data['status'],
            'password' => bcrypt($data['password']),
        ]);



        $user ->roles()->attach(Role::where('name', 'client' )->first());

        $name = $user->name;

        return redirect('/home');
       /* return redirect('login')->with('message', " $name account created kindly sing in to continue");*/


    }
    public function client_view(){

        return view('client.client');
    }
}
