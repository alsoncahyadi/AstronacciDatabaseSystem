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
        //
        factory(App\User::class, 20)->create();
        $this->createUserSeeder();


    }

    public function createUserSeeder() {
		$seeder_user = new App\User;
		$seeder_user->id = 999;
		$seeder_user->username = 'seeder_dummy';
		$seeder_user->fullname = 'seeder_dummy';
		$seeder_user->email = 'seeder@dummy.com';
		$seeder_user->password = 'password_seeder';
		$seeder_user->no_handphone = '-';
		$seeder_user->role = -1;
		$seeder_user->remember_token = '-';
		$seeder_user->save();
    }
}
