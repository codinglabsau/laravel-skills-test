<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        factory(\App\User::class)->create([
            'name' => 'Andy Parinas',
            'email' => 'andy.parinas@gmail.com',
        ]);

    }
}
