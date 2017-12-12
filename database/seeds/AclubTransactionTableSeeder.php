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
        $this->makeMagicSeedAclubTransaction(50);
        factory(App\AclubTransaction::class, 10)->create();
    }

    public function makeMagicSeedAclubTransaction($amount) {
        for ($i = 0; $i < $amount; $i++) {
            $magic_seed = new App\AclubTransaction;
            $magic_seed->user_id = 999999;  
            $magic_seed->payment_date = new DateTime('1970-02-01');
            $magic_seed->kode = 'XX';
            $magic_seed->status = 'XX';
            $magic_seed->nominal = 0;
            $magic_seed->start_date = new DateTime('1970-02-01');
            $magic_seed->sales_name = new DateTime('1970-02-01');
            $magic_seed->expired_date = new DateTime('1970-02-01');
            $magic_seed->masa_tenggang = new DateTime('1970-02-01');
            $magic_seed->yellow_zone = new DateTime('1970-02-01');
            $magic_seed->red_zone = new DateTime('1970-02-01');
            $magic_seed->created_by = 999;
            $magic_seed->updated_by = 999;
            $magic_seed->save();
        }
    }

        // 'user_id' => $faker->unique()->randomElement(App\AclubMember::pluck('user_id')->toArray()),
        // 'payment_date' => $faker->dateTimeBetween($startDate = "now", $endDate = "30 days")->format('Y-m-d'),
        // 'kode' => $kode,
        // 'status' => $faker->randomElement(['Baru', 'Perpanjang','Tidak Aktif']), 
        // 'nominal' => $faker->randomNumber($nbDigits = 2)*10000,
        // 'start_date' => $start,
        // 'sales_name' => $faker->name,
        // 'expired_date' => ($start->add(new DateInterval($PXD))),
        // 'masa_tenggang' => ($start->add(new DateInterval($PXD))),
        // 'yellow_zone' => ($start->add(new DateInterval($PXD))),
        // 'red_zone' => ($start->add(new DateInterval($PXD))),
        // 'created_by' => 999,
        // 'updated_by' => 999,              
}
