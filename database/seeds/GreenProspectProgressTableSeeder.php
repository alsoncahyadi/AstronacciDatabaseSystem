<?php

use Illuminate\Database\Seeder;

class GreenProspectProgressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
	    factory(App\GreenProspectProgress::class, 10)->create();
    }
}
