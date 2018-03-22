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
        $this->makeMagicSeedAclubMember();
        factory(App\AclubMember::class, 10)->create();
    }

    public function makeMagicSeedAclubMember() {
        $magic_seed = new App\AclubMember;
        $magic_seed->user_id = 999999;
        $magic_seed->master_id = 999999;
        $magic_seed->created_by = 999;
        $magic_seed->updated_by = 999;
        $magic_seed->save();
    }
}
