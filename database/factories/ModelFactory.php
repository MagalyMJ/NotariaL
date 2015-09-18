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


 $factory->define(NotiAPP\Models\Custumer::class,function(Faker\Generator $faker){
 	return [
 		'name' => $faker->firstName($gender = null|'male'|'female'),
        'fathers_last_name' => $faker->lastName,
        'mothers_last_name' => $faker->lastName,
        'rfc' => $faker->sentence($nbWords = 6),
        'birthdate' => $faker->date($format = 'd-m-Y', $max = 'now'),
        'marital_status' => $faker->randomElement($array = array (4,3,2,1)),
        'occupation' => $faker->word,
        'from' => $faker->country,
 	];
 });

$factory->define(NotiAPP\Models\Service::class,function(Faker\Generator $faker){
 return [
    'name' => $faker->firstName($gender = null|'male'|'female'),
    'service_type'=> $faker->randomElement($array = array (2,1)),
 ];
});

$factory->define(NotiAPP\Models\Expense::class,function(Faker\Generator $faker){
 return [
    'expense_name' => $faker->word,
    'cost'=> numberBetween($min = 1000, $max = 3000)
 ];
});

$factory->define(NotiAPP\Models\Document::class,function(Faker\Generator $faker){
 return [
    'document_name' => $faker->word,
 ];
});

// $factory->define(NotiAPP\Models\Address::class,function(Faker\Generator $faker){
// 	return [];
// });
