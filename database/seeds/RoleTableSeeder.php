<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role_administrator = new Role();
        $role_administrator->name = 'administrator';
        $role_administrator->description = 'administrator user';
        $role_administrator->status = '1';
        $role_administrator->save();

        $role_teamLeader = new Role();
        $role_teamLeader->name = 'teamLeader';
        $role_teamLeader->description = 'Team Leader user';
        $role_teamLeader->status = '1';
        $role_teamLeader->save();

        $role_operationsHead = new Role();
        $role_operationsHead->name = 'operationsHead';
        $role_operationsHead->description = 'Head of operations user';
        $role_operationsHead->status = '1';
        $role_operationsHead->save();


    }
}
