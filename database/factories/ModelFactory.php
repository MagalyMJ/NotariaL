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

$factory->define(NotiAPP\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName($gender = null|'male'|'female'),
        'fathers_last_name' => $faker->lastName,
        'mothers_last_name' => $faker->lastName,
        'user_name' => $faker->userName,
        'user_type' => $faker->randomElement($array = array (3,2,1)),
        'email' => $faker->email,
        'password' => bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(NotiAPP\Models\Address::class,function(Faker\Generator $faker){
	return [
		'street' => $faker->streetName,
		'number' => $faker->buildingNumber,
		'colony' => $faker->city,
		'postal_code'=> $faker->postcode,
		'observations' => $faker->sentence($nbWords = 15),
	];
});

// $factory->define(NotiAPP\Models\Address::class,function(Faker\Generator $faker){
// 	return [];
// });
