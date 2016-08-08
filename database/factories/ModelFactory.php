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
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Curso::class, function (Faker\Generator $faker) {
   return [
       'nome' => $faker->jobTitle,
       'sigla' => strtoupper($faker->word)
   ];
});

$factory->define(App\Models\AtividadeStatus::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->word
    ];
});

$factory->define(App\Models\AtividadeTipo::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->word
    ];
});

$factory->define(App\Models\Local::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->streetName
    ];
});

$factory->define(App\Models\UsuarioGrupo::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->word
    ];
});

$factory->define(App\Models\UsuarioTipo::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->citySuffix
    ];
});

$factory->define(App\Models\Aparencia::class, function (Faker\Generator $faker) {
    return [
        'tema' => $faker->word
    ];
});

