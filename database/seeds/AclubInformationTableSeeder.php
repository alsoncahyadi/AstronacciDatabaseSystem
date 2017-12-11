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
        $this->makeMagicSeedAclubInformation();
        factory(App\AclubInformation::class, 10)->create();
    }

    public function makeMagicSeedAclubInformation() {
        $magic_seed = new App\AclubInformation;
        $magic_seed->master_id = 999999;
        $magic_seed->sumber_data = '-';
        $magic_seed->keterangan = '-';
        $magic_seed->created_by = 999;
        $magic_seed->updated_by = 999;
        $magic_seed->save();         
    }    
}
