<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
		'username' => $faker->unique()->firstNameFemale,
		'fullname' => $faker->firstNameFemale,
		'email' => $faker->unique()->safeEmail,
		'password' => 'password',
		'no_handphone' => $faker->phoneNumber,
		'role' => $faker->randomElement([0,1,2,3]),	
		'remember_token' => 'remember_token'
    ];
});

