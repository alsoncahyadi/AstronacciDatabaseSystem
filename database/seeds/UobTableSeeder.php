<?php

use Illuminate\Database\Seeder;

class UobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Uob::class, 1000)->create();
    }
}
