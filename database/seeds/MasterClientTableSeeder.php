<?php

use Illuminate\Database\Seeder;

class MasterClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $master = new \App\MasterClient;
        $master->redclub_user_id = '1';
        $master->redclub_password = '12345';
        $master->name = 'Jovian';
        $master->email = 'christiantojovian@gmail.com';
        $master->save();
    }
}
