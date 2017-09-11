<?php

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
