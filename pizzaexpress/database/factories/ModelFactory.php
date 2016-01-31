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

$factory->define(pizzaexpress\Models\User::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\pt_BR\Person($faker));
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(pizzaexpress\Models\Category::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\pt_BR\Person($faker));
    return [
        'name' => $faker->word
    ];
});


$factory->define(pizzaexpress\Models\Product::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\pt_BR\Person($faker));
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'price' => $faker->numberBetween(10, 50)
    ];
});

$factory->define(pizzaexpress\Models\Client::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\pt_BR\Person($faker));
    return [
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'city' => $faker->city,
        'state' => $faker->state,
        'zipcode' => $faker->postcode
    ];
});

$factory->define(pizzaexpress\Models\Order::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\pt_BR\Person($faker));
    return [
        'client_id' => rand(1, 20),
        'total' => rand(40, 100),
        'status' => 0,
    ];
});

$factory->define(pizzaexpress\Models\OrderItem::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\pt_BR\Person($faker));
    return [

    ];
});

$factory->define(pizzaexpress\Models\Cupom::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\pt_BR\Person($faker));
    return [
        'code'=>rand(100, 1000),
        'value'=>rand(50,100),

    ];
});
