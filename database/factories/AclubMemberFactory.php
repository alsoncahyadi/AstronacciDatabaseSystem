<?php

$factory->define(App\AclubMember::class, function (Faker\Generator $faker) {
    $date = new Carbon\Carbon();

    return [
        'user_id' => $faker->unique()->randomNumber($nbDigits = 3), 
        'master_id' => $faker->randomElement(App\AclubInformation::pluck('master_id')->toArray()),
        // 'group' => $faker->randomElement(['Stock', 'Future', 'R']),
		'group' => $faker->randomElement(['Stock']),
        'created_by' => 999,
        'updated_by' => 999,      
    ];
});