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

$factory->define(App\Mrg::class, function (Faker\Generator $faker) {
    static $password;
    $date = new Carbon\Carbon();

    return [
    	'master_id' => $faker->unique()->randomElement(App\MasterClient::pluck('master_id')->toArray()),
		'sumber_data' => $faker->name,
		'join_date' => $faker->dateTimeBetween($startDate = "now", $endDate = "30 days")->format('Y-m-d'),
    ];
});

$factory->define(App\MrgAccount::class, function (Faker\Generator $faker) {
    static $password;
    $date = new Carbon\Carbon();

    return [
		'accounts_number' => $faker->unique()->randomNumber($nbDigits = 3),
		'master_id' => $faker->randomElement(App\Mrg::pluck('master_id')->toArray()),
		'account_type' => $faker->randomElement(['Recreation','Basic','Syariah','Signature']),
		'sales_name' => $faker->name,
    ];
});

$factory->define(App\AshopTransaction::class, function (Faker\Generator $faker) {
    static $password;
    $date = new Carbon\Carbon();

    return [
		'master_id' => $faker->unique()->randomElement(App\MasterClient::pluck('master_id')->toArray()),
		'product_type' => $faker->randomElement(['Video','E-Book','Seasonal Report','Event','Others']),
		'product_name' => 'Product'.$faker->unique()->randomNumber($nbDigits = 2),
		'nominal' => $faker->randomNumber($nbDigits = 2)*10000,
    ];
});


$factory->define(App\AclubInformation::class, function (Faker\Generator $faker) {
    $date = new Carbon\Carbon();

    return [
		'master_id' => $faker->unique()->randomElement(App\MasterClient::pluck('master_id')->toArray()),
    	//'master_id' => $faker->unique()->randomNumber($nbDigits = 3),
		'sumber_data' => $faker->name,
		'keterangan' => '-'
    ];
});

$factory->define(App\AclubMember::class, function (Faker\Generator $faker) {
    $date = new Carbon\Carbon();

    return [
		'user_id' => $faker->unique()->randomNumber($nbDigits = 3), 
		'master_id' => $faker->randomElement(App\AclubInformation::pluck('master_id')->toArray()),
		'group' => $faker->randomElement(['S', 'F', 'R']),
    ];
});

$factory->define(App\AclubTransaction::class, function (Faker\Generator $faker) {
    $date = new Carbon\Carbon();
    $kode = $faker->randomElement(['SS','SG','SP','FS','FG','FP', 'RD']);
    if ($kode[1] = 'S') {
    	$days = 30;
    } else if ($kode[1] = 'G') {
    	$days = 180;
    } else if ($kode[1] = 'P') {
    	$days = 365;
    } else if ($kode = 'RD') {
    	$days = 365;
    } 

    $start = $faker->dateTimeBetween($startDate = "now", $endDate = "30 days");
    $PXD = 'P'.$days.'D';
    //echo $PXD;

    return [
		'user_id' => $faker->unique()->randomElement(App\AclubMember::pluck('user_id')->toArray()),
		'payment_date' => $faker->dateTimeBetween($startDate = "now", $endDate = "30 days")->format('Y-m-d'),
		'kode' => $kode,
		'status' => $faker->randomElement(['Baru', 'Perpanjang','Tidak Aktif']), 
		'nominal' => $faker->randomNumber($nbDigits = 2)*10000,
		'start_date' => $start,
		'expired_date' => ($start->add(new DateInterval($PXD)))->format('Y-m-d'),
		'masa_tenggang' => ($start->add(new DateInterval($PXD)))->format('Y-m-d'),
		'yellow_zone' => ($start->add(new DateInterval($PXD)))->format('Y-m-d'),
		'red_zone' => ($start->add(new DateInterval($PXD)))->format('Y-m-d'),
    ];
});

$factory->define(App\GreenProspectClient::class, function (Faker\Generator $faker) {
    return [
		'date' => $faker->dateTimeBetween($startDate = "now", $endDate = "30 days")->format('Y-m-d'),
		'name' => $faker->name,
		'phone' => $faker->phoneNumber,
		'email' => $faker->unique()->safeEmail,
		'interest' => 'Interest'.$faker->randomNumber($nbDigits = 2),
		'pemberi' => $faker->name,
		'sumber_data' => $faker->name,
		'keterangan_perintah' => 'keterangan_perintah'.$faker->randomNumber($nbDigits = 2),
    ];
});



$factory->define(App\GreenProspectProgress::class, function (Faker\Generator $faker) {
    return [
		'green_id' => $faker->unique()->randomElement(App\GreenProspectClient::pluck('green_id')->toArray()),
		'date' => $faker->dateTimeBetween($startDate = "now", $endDate = "30 days")->format('Y-m-d'),
		'sales_name' =>  $faker->name,
		'status' => $faker->randomElement(['GOAL-BUY', 'GOAL-JOIN','NO ANSWER', 'NO GOAL', 'IN PROGRESS']), 
		'nama_product' => $faker->randomElement(['UOB','CAT','A-CLUB','MRG']), 
		'nominal' => $faker->randomNumber($nbDigits = 2)*10000,
		'keterangan' => '-'
    ];
});