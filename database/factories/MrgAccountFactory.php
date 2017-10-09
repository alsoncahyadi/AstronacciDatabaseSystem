<?php

$factory->define(App\MrgAccount::class, function (Faker\Generator $faker) {
    static $password;
    $date = new Carbon\Carbon();

    return [
        'accounts_number' => $faker->unique()->randomNumber($nbDigits = 3),
        'master_id' => $faker->randomElement(App\Mrg::pluck('master_id')->toArray()),
        'sales_name' => $faker->name,
        'account_type' => $faker->randomElement(['Recreation','Basic','Syariah','Signature']),
        'created_by' => 999,
        'updated_by' => 999,      
    ];
});