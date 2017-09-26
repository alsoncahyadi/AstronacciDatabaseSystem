<?php

use Illuminate\Database\Seeder;

class AclubMemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\AclubMember::class, 10)->create();
    }
}
