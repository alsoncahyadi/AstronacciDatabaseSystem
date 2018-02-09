<?php

$factory->define(App\GreenProspectClient::class, function (Faker\Generator $faker) {
    return [
        'date' => $faker->dateTimeBetween($startDate = "now", $endDate = "30 days")->format('Y-m-d'),
        'name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'interest' => 'Interest '.$faker->randomNumber($nbDigits = 2),
        'pemberi' => $faker->name,
        'sumber_data' => $faker->name,
        'keterangan_perintah' => 'keterangan perintah no. '.$faker->randomNumber($nbDigits = 2),
        'created_by' => 999,
        'updated_by' => 999,
    ];
});