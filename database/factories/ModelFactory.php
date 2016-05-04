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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt('password'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Org::class, function (Faker\Generator $faker) {
    return [
        'name'			=> $faker->company,
        'user_id'       => factory('App\User')->create()->id,
        'logo' 			=> $faker->url,
        'short_desc' 	=> $faker->words($nb = 16, $asText = true),
        'long_desc' 	=> $faker->paragraph(4),
        'website' 		=> $faker->domainName
    ];
});