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

$factory->define(App\User::class, function ($faker) {
    $name = str_replace('.','',$faker->name);
    $slug = str_replace(' ','-',strtolower($name));
    $rand = rand(0,1);
    $rand2 = rand(0,1);
    $rand3 = rand(0,1);
    
    return [
        'name' => $name,
        'slug' => $slug,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
        'description' => $faker->realText($maxNbChars = 255),
    ];
});
