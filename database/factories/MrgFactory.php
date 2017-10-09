<?php

$factory->define(App\Mrg::class, function (Faker\Generator $faker) {
    static $password;
    $date = new Carbon\Carbon();

    return [
        'master_id' => $faker->unique()->randomElement(App\MasterClient::pluck('master_id')->toArray()),
        'sumber_data' => $faker->name,
        'join_date' => $faker->dateTimeBetween($startDate = "now", $endDate = "30 days")->format('Y-m-d'),
        'created_by' => 999,
        'updated_by' => 999,      
    ];
});