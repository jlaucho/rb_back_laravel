<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'apellido' => $faker->lastName,
        'direccion' => 'Alguna direccion del usuario',
        'telefono'  => '04165608003',
        'cedula' => '14136448',
        'type'  => 'superAdmin',
        'email' => 'jlaucho@gmail.com',
        'password' => bcrypt('14460484'), // secret
        'remember_token' => str_random(10),
    ];
});
