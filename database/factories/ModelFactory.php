<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


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


$factory->define(App\Uob::class, function (Faker\Generator $faker) {
    static $password;
    $date = new Carbon\Carbon();

    return [
		'client_id' => $faker->unique()->randomNumber($nbDigits = 5),
		'master_id' => $faker->randomElement(App\MasterClient::pluck('master_id')->toArray()),
		'sales_name' =>  $faker->name,
		'sumber_data' => '-',
		'join_date' => $faker->dateTimeBetween($startDate = "now", $endDate = "30 days")->format('Y-m-d'),
		'nomor_ktp' => $faker->randomNumber($nbDigits = 5),
		'tanggal_expired_ktp' => $faker->dateTimeBetween($startDate = "now", $endDate = "30 days")->format('Y-m-d'),
		'nomor_npwp' => $faker->randomNumber($nbDigits = 5),
		'alamat_surat' => $faker->address,
		'saudara_tidak_serumah' => $faker->name,
		'nama_ibu_kandung' => $faker->firstNameFemale,
		'bank_pribadi' => 'BCA',
		'nomor_rekening_pribadi' => $faker->randomNumber($nbDigits = 5),
		'tanggal_rdi_done' => $faker->dateTimeBetween($startDate = "now", $endDate = "30 days")->format('Y-m-d'),
		'rdi_bank' => '-',
		'nomor_rdi' => $faker->randomNumber($nbDigits = 5),
		'tanggal_top_up' => $faker->dateTimeBetween($startDate = "now", $endDate = "30 days")->format('Y-m-d'),
		'nominal_top_up' => $faker->randomNumber($nbDigits = 2)*10000,
		'tanggal_trading' => $faker->dateTimeBetween($startDate = "now", $endDate = "30 days")->format('Y-m-d'),
		'status' => '-',
		'trading_via' => '-',
		'keterangan' => '-',
    ];
});
