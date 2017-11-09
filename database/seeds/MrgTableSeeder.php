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
        $this->makeMagicSeedMrg();
        factory(App\Mrg::class, 20)->create();
    }

    public function makeMagicSeedMrg() {
        $magic_seed = new App\Mrg;
        $magic_seed->master_id = 999999;
        $magic_seed->sumber_data = '-';
        $magic_seed->join_date = new DateTime('1970-02-01');
        $magic_seed->created_by = 999;
        $magic_seed->updated_by = 999;
        $magic_seed->save();
    }    
}
