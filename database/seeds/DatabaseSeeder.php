<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
       $this->call(UserTableSeeder::class);
        // Role comes before User seeder here.

        // User seeder will use the roles above created.

    }
}
