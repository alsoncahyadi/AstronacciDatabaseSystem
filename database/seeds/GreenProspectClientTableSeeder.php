<?php

use Illuminate\Database\Seeder;

class GreenProspectClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
	    factory(App\GreenProspectClient::class, 10)->create();
    }
}
