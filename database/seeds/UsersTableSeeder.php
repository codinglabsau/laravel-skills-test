<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create a user 
        DB::table('users')->insert([
            'name' => "Tom",
            'email' => "tom@a.org",
            'password' => bcrypt("secret"),
        ]);

    }
}
