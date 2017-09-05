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
    }
}
