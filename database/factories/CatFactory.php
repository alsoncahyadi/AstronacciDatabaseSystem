<?php

$factory->define(App\Cat::class, function (Faker\Generator $faker) {
    static $password;
    $date = new Carbon\Carbon();

    return [
        'user_id' => $faker->unique()->randomNumber($nbDigits = 5),
        'nomor_induk' => $faker->unique()->name,
        'master_id' => $faker->randomElement(App\MasterClient::pluck('master_id')->toArray()),
        'batch' => $faker->randomDigit,
        'sales' => $faker->name,
        'sumber_data' => '-',
        'DP_date' => $faker->dateTimeBetween($startDate = "now", $endDate = "30 days")->format('Y-m-d'),
        'DP_nominal' => 0,
        'payment_date' => $faker->dateTimeBetween($startDate = "now", $endDate = "30 days")->format('Y-m-d'),
        'payment_nominal' => 0,
        'tanggal_opening_class' => $faker->dateTimeBetween($startDate = "now", $endDate = "30 days")->format('Y-m-d'),
        'tanggal_end_class' => $faker->dateTimeBetween($startDate = "now", $endDate = "30 days")->format('Y-m-d'),
        'tanggal_ujian' => $faker->dateTimeBetween($startDate = "now", $endDate = "30 days")->format('Y-m-d'),
        'status' => '-',
        'keterangan' => '-',
    ];
});