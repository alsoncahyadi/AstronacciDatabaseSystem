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
        $this->makeMagicSeedMrgAccount(100);
        factory(App\MrgAccount::class, 20)->create();        
    }

    public function makeMagicSeedMrgAccount($amount) {
        for ($i = 0; $i < $amount; $i++) {        
            $magic_seed = new App\MrgAccount;
            $magic_seed->accounts_number = 999999 - ($amount);
            $magic_seed->master_id = 999999;
            $magic_seed->sales_name = 'MAGIC_SEED_SALES';
            $magic_seed->account_type = 'MAGIC_SEED_ACCOUNT';
            $magic_seed->created_by = 999;
            $magic_seed->updated_by = 999;
        }
    }
}
