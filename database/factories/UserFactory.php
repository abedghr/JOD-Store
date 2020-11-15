<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Message;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
$factory->define(Message::class, function (Faker $faker) {
    
    do {
        $from_provider = rand(1,7);
        $from_user = rand(1,9);
        $to_provider = rand(1,7);
        $to_user = rand(1,9);
        $is_read = rand(0,1);
    }while($from_provider === $to_user || $from_user === $to_provider);
    
    return [
        'from_provider' => $from_provider,
        'from_user' => $from_user,
        'to_provider' => $to_provider,
        'to_user' => $to_user,
        'message' => $faker->sentence(),
        'is_read' => $is_read
    ];
});
