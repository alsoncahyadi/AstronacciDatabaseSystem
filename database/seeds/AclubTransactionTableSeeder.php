<?php

use Illuminate\Database\Seeder;

class AclubTransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\AclubTransaction::class, 10)->create();
    }
}
