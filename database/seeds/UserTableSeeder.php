<?php

use Illuminate\Database\Seeder;
use \App\User;

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
        $user = new User;
		$user->fill(['name' => 'Erick Mo', 'email' => 'erick.mo@vortege.com', 'password' => '123123123', 'is_admin' => true]);
		if (!$user->save())
		{
			dd($user->getErrors());
		}

		for ($i = 0; $i <= 10; $i++)
		{
			$user = new User;
			$user->fill(['name' => 'Member ' . $i, 'email' => 'member.'.$i.'@gmail.com', 'password' => '123123123', 'is_admin' => false]);
			if (!$user->save())
			{
				dd($user->getErrors());
			}
		}
    }
}
