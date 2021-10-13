<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder {

	public function run()
	{

		$items = [
			[
				'user_id' 		=> 1,
				'name'			=> 'Admin',
				'email' 		=> 'admin@admin.com',
				'password'  	=> '$2y$10$xuOdtgvXw1jeBDBrqOyZxOH4UXVeOOdY/Lo84n/1Rjtj1n./iGdrO' // Password:- 123
			]
		];

		foreach($items as $item) {

			$user_id		= $item['user_id'];
			$name			= $item['name'];
			$email			= $item['email'];
			$password		= $item['password'];

			$dbitem = User::where([
				'user_id' => $user_id
			])->first();
			if(empty($dbitem)) {
				$dbitem 		= new User();
			}

			$dbitem->user_id 		= $user_id;
			$dbitem->name 			= $name;
			$dbitem->email 			= $email;
			$dbitem->password 		= $password;
			
			$dbitem->save();
		}

	}

}