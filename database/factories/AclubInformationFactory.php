<?php

$factory->define(App\AclubInformation::class, function (Faker\Generator $faker) {
    $date = new Carbon\Carbon();

    return [
        'master_id' => $faker->unique()->randomElement(App\MasterClient::pluck('master_id')->toArray()),
        //'master_id' => $faker->unique()->randomNumber($nbDigits = 3),
        'sumber_data' => $faker->name,
        'keterangan' => '-',
        'created_by' => 999,
        'updated_by' => 999,        
    ];
});