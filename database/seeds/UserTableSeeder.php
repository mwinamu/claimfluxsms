<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role_administrator = Role::where( 'name' , 'administrator' )->first();
        $role_teamLeader = Role::where( 'name' , 'teamLeader' )->first();

        $administrator = new User();
        $administrator->name =  'administrator name';
        $administrator->email = 'hmwinamu@questholdings.biz';
        $administrator->status ='1';
        $administrator->password = bcrypt( 'Password.' );
        $administrator->save();
        $administrator->roles()->attach( $role_administrator );

         $teamLeader = new User();
        $teamLeader->name = 'teamLeader name';
        $teamLeader->email = 'mwinamu@gmail.com';
        $teamLeader->status = '1';
        $teamLeader->password = bcrypt( 'Password.' );
        $teamLeader->save();
        $teamLeader->roles()->attach( $role_teamLeader );


    }
}
