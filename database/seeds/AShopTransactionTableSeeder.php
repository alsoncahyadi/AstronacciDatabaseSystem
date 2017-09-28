<?php

use Illuminate\Database\Seeder;

class AShopTransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\AshopTransaction::class, 20)->create();
    }
}
