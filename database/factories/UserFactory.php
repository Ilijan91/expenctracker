<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Seller;
use App\Vendor;
use App\Category;
use App\Transaction;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'verified' => $verified = $faker->randomElement([User::VERIFIED_USER, User::UNVERIFIED_USER]),
        'verification_token' => $verified == User::VERIFIED_USER ? null : User::generateVerificationCode(),
        'remember_token' => Str::random(10),
    ];
});


$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word(1),
        'description' => $faker->paragraph(1),
    ];
});

$factory->define(Vendor::class, function (Faker $faker) {
  
    return [
        'name' => $faker->word(1),
        'description' => $faker->paragraph(1),
        'amount' => $faker->numberBetween(1, 10),
        'status' => $faker->randomElement([Vendor::AVAILABLE_VENDOR, Vendor::UNAVAILABLE_VENDOR]),
        'seller_id' => User::all()->random()->id,
    ];
});


$factory->define(Transaction::class, function (Faker $faker) {
    
    $seller = Seller::has('vendors')->get()->random();
   
    $buyer = User::all()->except($seller->id)->random();
    return [
        'amount' => $faker->numberBetween(1, 3),
        'buyer_id' => $buyer->id,
        'currency' => $faker->randomElement(['EUR', 'RSD', 'USD']),
        'vendor_id' => $seller->vendors->random()->id,
    ];
});