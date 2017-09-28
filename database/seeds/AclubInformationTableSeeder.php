<?php

use Illuminate\Database\Seeder;

class AclubInformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\AclubInformation::class, 10)->create();
    }
}
