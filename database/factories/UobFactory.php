<?php

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