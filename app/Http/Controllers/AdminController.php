<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Request;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //


    public function dashboard(){


        return view( 'admin.dashboard' );
    }

    public function userView(){
        
        $users = User::get()->all();

        return view( 'users.index' );
    }
    public function editModal(){
        
        return view( 'client.editModal' );
    }
}   