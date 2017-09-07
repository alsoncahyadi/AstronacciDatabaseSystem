<?php

use Illuminate\Database\Seeder;

class MrgAccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\MrgAccount::class, 20)->create();        
    }
}
