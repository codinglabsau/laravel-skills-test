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
        $count = 1;
        factory(App\User::class, $count)->create();
        // $this->call(UsersTableSeeder::class);
    }
}
