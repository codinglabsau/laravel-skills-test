<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Jesse',
            'email'=> 'jesse@gmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
