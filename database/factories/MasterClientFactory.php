<?php

$factory->define(App\MasterClient::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'redclub_user_id' => $faker->randomNumber($nbDigits = NULL),
        'redclub_password' => 'password',
        'name' => $faker->firstNameMale,
        'telephone_number' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'birthdate' => $faker->dateTimeThisCentury->format('Y-m-d'),
        'address' => $faker->address,
        'city' => $faker->address,
        'province' => $faker->address,
        'gender' => 'M',
        'line_id' => 'line_id_example',
        'bbm' => 'bbm_id_example',
        'whatsapp' => 'whatsapp_example',
        'facebook' => 'facebook_example',
    ];
});