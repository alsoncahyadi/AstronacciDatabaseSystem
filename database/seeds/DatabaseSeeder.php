<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MasterClientTableSeeder::class);
        $this->call(CatTableSeeder::class);
        $this->call(UobTableSeeder::class);
        $this->call(MrgTableSeeder::class);
        $this->call(MrgAccountTableSeeder::class);
        $this->call(AShopTransactionTableSeeder::class);
        $this->call(AclubInformationTableSeeder::class);
        $this->call(AclubMemberTableSeeder::class);
        $this->call(AclubTransactionTableSeeder::class);
        $this->call(GreenProspectClientTableSeeder::class);
        $this->call(GreenProspectProgressTableSeeder::class);
    }
}
