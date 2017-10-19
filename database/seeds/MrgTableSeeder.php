<?php

use Illuminate\Database\Seeder;

class MrgTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Mrg::class, 20)->create();
    }
}
