<?php 

$factory->define(App\AshopTransaction::class, function (Faker\Generator $faker) {
    static $password;
    $date = new Carbon\Carbon();

    return [
        'master_id' => $faker->randomElement(App\MasterClient::pluck('master_id')->toArray()),
        'product_type' => $faker->randomElement(['Video','E-Book','Seasonal Report','Event','Others']),
        'product_name' => 'Product-'.$faker->unique()->randomNumber($nbDigits = 2),
        'nominal' => $faker->randomNumber($nbDigits = 2)*10000,
        'created_by' => 999,
        'updated_by' => 999,      
    ];
});