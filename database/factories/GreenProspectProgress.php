<?php

$factory->define(App\GreenProspectProgress::class, function (Faker\Generator $faker) {
    return [
        'green_id' => $faker->unique()->randomElement(App\GreenProspectClient::pluck('green_id')->toArray()),
        'date' => $faker->dateTimeBetween($startDate = "now", $endDate = "30 days")->format('Y-m-d'),
        'sales_name' =>  $faker->name,
        'status' => $faker->randomElement(['GOAL-BUY', 'GOAL-JOIN','NO ANSWER', 'NO GOAL', 'IN PROGRESS']), 
        'nama_product' => $faker->randomElement(['UOB','CAT','A-CLUB','MRG']), 
        'nominal' => $faker->randomNumber($nbDigits = 2)*10000,
        'keterangan' => '-',
        'created_by' => 999,
        'updated_by' => 999,
    ];
});