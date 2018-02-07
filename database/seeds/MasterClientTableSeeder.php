<?php

use Illuminate\Database\Seeder;

class MasterClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->makeMagicSeedMasterClient();
        factory(App\MasterClient::class, 20000)->create();
    }

    public function makeMagicSeedMasterClient() {
        $magic_seed = new App\MasterClient;
        $magic_seed->master_id = 999999;
        $magic_seed->redclub_user_id = 999999;
        $magic_seed->redclub_password = 'password';
        $magic_seed->name = 'MAGIC_SEED';
        $magic_seed->telephone_number = 999999;
        $magic_seed->email = 'super@seed.com';
        $magic_seed->birthdate = new DateTime('1970-02-01');
        $magic_seed->address = 'address999';
        $magic_seed->city = 'city999';
        $magic_seed->province = 'province999';
        $magic_seed->gender = 'gender999';
        $magic_seed->line_id = 'line_id999';
        $magic_seed->bbm = 'bbm999';
        $magic_seed->whatsapp = 'whatsapp999';
        $magic_seed->facebook = 'facebook999';
        $magic_seed->created_by = 999;
        $magic_seed->updated_by = 999;
        $magic_seed->save();         
    }

}
